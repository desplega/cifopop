<?php

namespace App\Http\Controllers\Emails;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|max:64',
            'email' => 'required|email:rfc',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $msg = new \stdClass();
        $msg->name = $request->name;
        $msg->subject = $request->subject;
        $msg->email = $request->email;
        $msg->message = $request->message;

        Mail::to('info@cifopop.com')->send(new Contact($msg));

        return redirect()
            ->route('advert.index')
            ->with('success', __('Message successfully sent.'));
    }
}
