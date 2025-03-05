<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBookMail extends Mailable
{
    use Queueable, SerializesModels;

    public $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function build()
    {
        return $this->subject('New Book Available: ' . $this->book->name)
                    ->view('emails.new_book')
                    ->with([
                        'book' => $this->book
                    ]);
    }
}
