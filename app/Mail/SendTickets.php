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
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;

class SendTickets extends Mailable
{
    use Queueable, SerializesModels;

    public $tickets;

    /**
     * Create a new message instance.
     *
     * @param UserTicketSales $ticket
     */
    public function __construct(UserTicketSales $ticket)
    {
        $this->tickets = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name       = 'Wallkill Lodge #627 Tickets';
        $subject    = 'Your event tickets are here!';
        $address    = 'sciaschi1@gmail.com';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('emails.base.ticket')->with([
            'tickets'   => $this->tickets,
            'event'     => $this->tickets->event()->get(),
        ])->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->view('emails.base.header')
                    ->from($address, $name)
                    ->subject($subject)
                    ->attachData($dompdf->output(), 'mytickets.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

//    public function __toString()
//    {
//        $view = View::make('emails.base.ticket');
//
//        return $view->render();
//    }
}
