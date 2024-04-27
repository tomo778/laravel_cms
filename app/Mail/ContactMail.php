<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = sprintf('お問い合わせありがとうございます', config('const.site_name'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $session_contact = session('contact');
        return $this
            ->text('emails.contact')
            //->view('emails.purchase')
            //->markdown('emails.test')
            ->subject($this->title)
            ->with([
                'name' => $session_contact['name'],
                'kanso' => $session_contact['kanso'],
            ]);
    }
}
