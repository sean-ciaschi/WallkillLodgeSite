<?php

namespace App\Models\Gallery\Album;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery\Album\Traits\Attribute\Attribute;
use App\Models\Gallery\Album\Traits\Relationship\Relationship;

class Album extends Model
{
    use Attribute, Relationship;

    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'albums';

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'created_at',
        'updated_at',
    ];

    /**
     * Hidden.
     *
     * @var array
     */
    protected $hidden = ['id'];
}
