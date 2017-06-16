<?php namespace App\Models\Gallery\Album;


use App\Models\Gallery\Album\Traits\Attribute\Attribute;
use App\Models\Gallery\Album\Traits\Relationship\Relationship;

class Album
{
    use Attribute, Relationship;

    protected $table = 'albums';

    protected $fillable = array('name','description','cover_image');


}