<?php namespace App\Models\Event;


use App\Models\Event\Traits\Attribute\Attribute;
use App\Models\Event\Traits\Relationship\Relationship;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Attribute, Relationship;

    /**
     * Table
     *
     * @var string
     */
    protected $table = "data_events";

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'location',
        'date',
        'price',
        'is_active',
        'created_at'
    ];

    /**
     * Hidden
     *
     * @var array
     */
    protected $hidden = ['id'];
}