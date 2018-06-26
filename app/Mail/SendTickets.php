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

    public $charge;

    /**
     * Create a new ticket instance.
     *
     * @param $ticketId
     * @param $chargeResponse
     */
    public function __construct($ticketId, $chargeResponse)
    {
        $this->ticket = UserTicketSales::find($ticketId);
        $this->charge = $chargeResponse;
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

        //Generate the tickets and send
        $dompdf->loadHtml(View::make('emails.base.ticket')->with([
            'tickets'   => $this->ticket,
            'event'     => $this->ticket->event()->get()
        ])->render());

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->view('emails.base.header')
                    ->with([
                        'charge'    => $this->charge
                    ])
                    ->from($address, $name)
                    ->subject($subject)
                    ->attachData($dompdf->output(), 'mytickets.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

    public function __toString()
    {
//        $str = '';
//
//        foreach(debug_backtrace() as $index => $trace)
//        {
//            if($index + 1 )
//            {
//                break;
//            }
//
//            $str .= sprintf(
//                "\n%s:%s %s::%s",
//                str_replace(base_path(), '', isset($trace['file']) ? $trace['file'] : ''),
//                isset($trace['line']) ? $trace['line'] : '',
//                isset($trace['class']) ? $trace['class'] : '',
//                isset($trace['function']) ? $trace['function'] : ''
//            );
//        }
//
//        return ($str);
        $ticketSale = UserTicketSales::find(3);

        $view = View::make('emails.base.ticket')->with([
            'tickets'   => $ticketSale,
            'event'     => $ticketSale->event()->get(),
        ])->render();

        return $view;
    }
}
