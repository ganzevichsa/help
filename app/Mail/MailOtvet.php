<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailOtvet extends Mailable
{
    //
    use Queueable, SerializesModels;

    protected $id;
    protected $body;
    protected $phone;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $body, $phone)
    {
        //
        $this->id = $id;
        $this->body = $body;
        $this->phone = $phone;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ITotvet')
            ->with([
                'id' => $this->id,
                'body' => $this->body,
                'phone' => $this->phone,
            ])
            ->subject('Ответ по заявке');
    }
}
