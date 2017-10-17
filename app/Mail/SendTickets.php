<?php namespace App\Mail;

/**
 * Class SendTickets
 * @package App\Mail
 */

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
        dd($ticket);
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.base.base.ticket');
    }
}
