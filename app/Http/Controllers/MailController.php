<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\Answers;

class MailController extends Controller
{

    public function __invoke()
    {
        //Mail::to('cesaralejo@gmail.com')->locale('es')->send(new Answers);
        return view('mail.index');
    }
}
