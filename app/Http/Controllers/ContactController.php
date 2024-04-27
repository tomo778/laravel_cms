<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact.contact');
    }

    public function back()
    {
        $request = session('contact');
        return view('contact.contact', compact('request'));
    }

    public function confirm(ContactRequest $Request)
    {
        session(['contact' => $Request->all()]);
        return view('contact.confirm');
    }

    public function finish()
    {
        $this->sendMail();
        $this->saveSession();
        return view('contact.finish');
    }

    private function sendMail()
    {
        $to = 'test@gmail.com';
        $cc = 'cc@mail.com';
        $bcc = 'bcc@mail.com';
        Mail::to($to)
            ->cc($cc)
            ->bcc($bcc)
            ->send(new ContactMail());
    }

    private function saveSession()
    {
        session()->regenerateToken(); //2回メール送信を防ぐため
        session()->forget('contact');
    }
}
