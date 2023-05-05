<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendContactMail(Request $request)
    {
        $contactdata = [];
        $contactdata['name'] = $request->input('name');
        $contactdata['email'] = $request->input('email');
        $contactdata['messsage'] = $request->input('messsage');
    }
}
