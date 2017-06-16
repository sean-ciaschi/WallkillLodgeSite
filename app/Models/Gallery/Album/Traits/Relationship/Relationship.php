<?php namespace App\Models\Gallery\Album\Traits\Relationship;


trait Relationship
{
    public function photos(){

        return $this->has_many('images');
    }
}