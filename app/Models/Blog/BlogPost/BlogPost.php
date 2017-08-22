<?php namespace app\Models\Blog\BlogPost;

/**
 * BlogPosts Model
 *
 * @author Sean Ciaschi
 */

use App\Models\Blog\BlogPost\Traits\Attribute\Attribute;
use App\Models\Blog\BlogPost\Traits\Relationship\Relationship;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use Attribute, Relationship;
    /**
     * Blog Post Table
     *
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Fillable
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
        'updated_at'
    ];
}