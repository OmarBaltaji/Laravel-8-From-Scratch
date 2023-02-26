<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements Feedable
{
    use HasFactory;
    
    protected $fillable = [ 'title', 'excerpt', 'body', 'slug', 'category_id', 'user_id', 'thumbnail', 'status' ];

    protected $casts = [
        'published_at' => 'datetime'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query
            ->when($filters['search'] ?? false, fn ($query, $search) =>
                $query->where(fn ($query) => 
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                )
            );

        $query->when($filters['category'] ?? false, fn ($query, $category) => 
            $query->whereHas('category', fn($query) => $query->where('slug', $category))
        );

        $query->when($filters['author'] ?? false, fn ($query, $author) => 
            $query->whereHas('author', fn($query) => $query->where('username', $author))
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->excerpt,
            'updated' => $this->updated_at,
            'link' => 'posts/' . $this->slug,
            'authorName' => $this->author->name,
            'category' => $this->category->name,
        ]);
    }

    public static function getFeedItems()
    {
        return Post::all();
    }

    public function views() 
    {
       return $this->hasMany(PostsUsersView::class);
    }
}
