<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __invoke(){
        $filename = Invoice::filaname();

         Notification::route('mail','admin@gmail.com')
         ->notify(new InvoicePaid($filename));
         return back();
    }
}
