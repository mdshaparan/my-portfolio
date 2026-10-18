<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Server-side DataTables helper, all in one place:
 * search, ordering, pagination, JSON response.
 */
class DataTableResponse
{
    /**
     * @param Builder  $query       Model::query()
     * @param array    $searchable  columns to search in: ['title', 'category']
     * @param array    $orderable   table er column index => database column: [1 => 'title']
     * @param callable $mapRow      converts each row model into an array
     * @param string   $defaultOrder default sorting column
     */
    public static function make(
        Request $request,
        Builder $query,
        array $searchable,
        array $orderable,
        callable $mapRow,
        string $defaultOrder = 'id',
        string $defaultDir = 'asc'
    ): JsonResponse {
        $total = (clone $query)->count();

        if ($search = trim((string) $request->input('search.value'))) {
            $query->where(function ($q) use ($search, $searchable) {
                foreach ($searchable as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        $filtered = (clone $query)->count();

        $column = $orderable[$request->input('order.0.column')] ?? $defaultOrder;
        $dir    = $request->has('order.0.dir')
            ? ($request->input('order.0.dir') === 'desc' ? 'desc' : 'asc')
            : $defaultDir;
        $query->orderBy($column, $dir)->orderBy('id');

        $length = (int) $request->input('length', 10);
        if ($length > 0) {
            $query->skip((int) $request->input('start', 0))->take($length);
        }

        return response()->json([
            'draw'            => (int) $request->input('draw'),
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $query->get()->map($mapRow)->values(),
        ]);
    }
}
