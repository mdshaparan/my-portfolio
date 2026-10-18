<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $slug = Menu::where('section_type', 'contact')->value('slug') ?: 'contact';
        $back = url('/') . '#' . $slug;

        // Honeypot: bots fill the hidden 'website' field, so silently ignore those
        if ($request->filled('website')) {
            return redirect($back)->with('contact_success', 'Thanks! Your message has been sent.');
        }

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:3000',
        ]);

        if ($validator->fails()) {
            return redirect($back)->withErrors($validator, 'contact')->withInput();
        }

        Message::create($validator->validated());

        return redirect($back)->with('contact_success', 'Thanks! Your message has been sent. I will reply as soon as possible.');
    }
}
