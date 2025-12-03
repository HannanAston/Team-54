<?php

namespace App\Http\Controllers;


use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function show() {
        return view('contact');
    }

    public function sendEnquiry(request $request) {
        $incomingFields = $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Mail::to('revivalthreads4@gmail.com')->send(new ContactMail($incomingFields));
        return redirect()->route('contact');
    }
}