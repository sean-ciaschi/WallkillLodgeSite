<?php namespace App\Models\Gallery\Images;


class Images
{
    protected $table = 'images';

    protected $fillable = array('album_id','description','image');
}