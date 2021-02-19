<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function contact()
    {
        return view('customer.contact');
    }

    public function contactPost(Request $request){
        $this->validate($request, [
                        'name' => 'required',
                        'email' => 'required|email',
                        'subject' => 'required',
                        'message' => 'required'
                ]);

        $mail = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('mahfudinnawawi@gmail.com')->send(new ContactMail($mail));

        return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');

    }
}
