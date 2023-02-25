<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
 
    // ! fillable is generally the safer option

    // protected $guarded = []; // Everything is fillable in mass assignment except for the ones mentioned in array
    
    protected $fillable = [ 'title', 'excerpt', 'body', 'slug', 'category_id', 'user_id', 'thumbnail' ]; // Nothing is fillable in mass assignment except for ones mentioned in array

    // protected $with = ['category', 'author']; // Eager load relations instead of writing with() and load() for each query
    // Also in this case we can use the ::without('relation') method where we want to perform a simple query for Post without eager loading the mentioned relations

    // public function getRouteKeyName() // Overwrites the main column to fetch the record (by default it's "id") (Route Model Relation) 
    // {
    //     return 'slug';
    // }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters) // Post::newQuery()->filter()
    {
        $query
            ->when($filters['search'] ?? false, fn ($query, $search) =>
                // here we are grouping the where conditions, OR here needs to be grouped because in case the search and category query got combined, it will not return accurate results
                $query->where(fn ($query) => 
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                )
            );

        // $query->when($filters['category'] ?? false, fn ($query, $category) =>
        //     $query->whereExists(fn($query) => 
        //         $query->from('categories')
        //             ->whereColumn('categories.id', 'posts.category_id')
        //             ->where('categories.slug', $category)
        //     )
        // );

        // Same as above expressions but in a cleaner way
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
}
