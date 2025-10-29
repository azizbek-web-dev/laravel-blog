<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Contact Controller
 * 
 * Handles contact form functionality allowing visitors to send
 * messages to the blog administrators.
 */
class ContactController extends Controller
{
    /**
     * Show the contact form
     *
     * @return View
     */
    public function create(): View
    {
        return view('contact');
    }

    /**
     * Store a new contact message
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'subject'    => 'required|string|max:150',
            'message'    => 'required|string|max:5000',
        ]);

        ContactMessage::create($request->all());

        return redirect()
            ->route('contact')
            ->with('success', 'Xabar muvaffaqiyatli yuborildi!');
    }
}
