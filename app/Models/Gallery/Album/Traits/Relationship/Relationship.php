<?php

namespace App\Models\Gallery\Album\Traits\Relationship;

use App\Models\Gallery\Images\Images;

trait Relationship
{
    /**
     * Relationship mapping for Album.
     *
     * @return mixed
     */
    public function images()
    {
        return $this->hasMany(Images::class, 'album_id');
    }
}
