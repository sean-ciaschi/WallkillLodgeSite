<?php

namespace App\Mail;

use App\Models\UserTicketSales\UserTicketSales;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTickets extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param UserTicketSales $ticket
     */
    public function __construct(UserTicketSales $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd(1);
        return $this->view('emails.base.base.ticket');
    }
}
