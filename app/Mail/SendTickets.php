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
     * @param $ticketId
     */
    public function __construct($ticketId)
    {
        $this->ticket = UserTicketSales::find($ticketId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Define the email headers/name/subject and who its being sent to
        $name       = 'Wallkill Lodge #627 Tickets';
        $subject    = 'Your event tickets are here!';
        $address    = $this->ticket->buyer_email;

        // Instantiate and use the dompdf class
        $dompdf = new Dompdf();

        //Genereate the tickets and
        $dompdf->loadHtml(View::make('emails.base.ticket')->with([
            'tickets'   => $this->ticket,
            'event'     => $this->ticket->event()->get(),
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
