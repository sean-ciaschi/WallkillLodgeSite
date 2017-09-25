<?php

namespace App\Models\Gallery\Images\Traits\Relationship;

use App\Models\Gallery\Album\Album;

trait Relationship
{
    /**
     * Relationship mapping for Album.
     *
     * @return mixed
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
