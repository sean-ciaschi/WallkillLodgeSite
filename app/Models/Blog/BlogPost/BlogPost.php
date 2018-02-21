<?php namespace App\Models\Blog\BlogPost;

/*
 * BlogPosts Model
 *
 * @author Sean Ciaschi
 */

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPost\Traits\Attribute\Attribute;
use App\Models\Blog\BlogPost\Traits\Relationship\Relationship;

class BlogPost extends Model
{
    use Attribute, Relationship;
    /**
     * Blog Post Table.
     *
     * @var string
     */
    protected $table = 'blog_posts';

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
        'user_id',
        'title',
        'content',
        'attachment_path',
        'date',
        'created_at',
        'updated_at',
    ];
}
