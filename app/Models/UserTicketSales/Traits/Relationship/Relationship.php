<?php namespace App\Models\UserTicketSales\Traits\Relationship;

use App\Models\TicketSales\TicketSales;

trait Relationship
{
    public function event()
    {
        return $this->belongsTo(TicketSales::class);
    }
}
