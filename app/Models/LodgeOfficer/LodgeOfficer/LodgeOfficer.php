<?php namespace App\Models\Blog\BlogPost;

/*
 * BlogPosts Model
 *
 * @author Sean Ciaschi
 */

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPost\Traits\Attribute\Attribute;
use App\Models\Blog\BlogPost\Traits\Relationship\Relationship;

class LodgeOfficer extends Model
{
    use Attribute, Relationship;
    /**
     * Blog Post Table.
     *
     * @var string
     */
    protected $table = 'data_lodge_officers';

    /**
     * Dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'office',
        'image_path',
        'created_at',
        'updated_at',
    ];
}
