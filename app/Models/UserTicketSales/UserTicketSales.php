<?php namespace App\Models\UserTicketSales;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserTicketSales\Traits\Attribute\Attribute;
use App\Models\UserTicketSales\Traits\Relationship\Relationship;

class UserTicketSales extends Model
{
    use Attribute, Relationship;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'data_tickets';

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'buyer_name',
        'buyer_email',
        'quantity',
        'created_at',
    ];

    /**
     * Hidden.
     *
     * @var array
     */
    protected $hidden = ['id'];
}
