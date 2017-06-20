<?php namespace App\Models\Gallery\Album;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = "albums";

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'created_at',
        'updated_at'
    ];

    /**
     * Hidden
     *
     * @var array
     */
    protected $hidden = ['id'];
}