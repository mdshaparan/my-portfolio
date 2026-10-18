<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Support\DataTableResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('backend.messages.index');
    }

    // DataTables server-side data
    public function data(Request $request)
    {
        return DataTableResponse::make(
            $request,
            Message::query(),
            ['name', 'email', 'subject', 'message'],
            [1 => 'name', 2 => 'email', 3 => 'subject', 4 => 'created_at'],
            fn ($row) => [
                'action'     => view('backend.messages._actions', ['item' => $row])->render(),
                'name'       => $row->is_read ? e($row->name) : '<strong>' . e($row->name) . '</strong>',
                'email'      => e($row->email),
                'subject'    => e($row->subject),
                'created_at' => $row->created_at->format('d M Y, h:i A'),
                'status'     => $row->is_read
                    ? '<span class="badge bg-secondary">Read</span>'
                    : '<span class="badge bg-danger">New</span>',
            ],
            'created_at',
            'desc'
        );
    }

    public function show(Message $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('backend.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}
