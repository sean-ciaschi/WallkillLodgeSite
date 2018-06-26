<?php

namespace App\Models\Gallery\Images;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'album_id',
        'image',
        'description',
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
