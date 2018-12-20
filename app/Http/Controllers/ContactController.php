<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function form()
    {
        return view("contact/form");
    }

    public function send(ContactRequest $request)
    {
        Mail::to("tboileau.info@gmail.com")->send(new ContactMail($request->all()));
        return response("OK");
    }
}
