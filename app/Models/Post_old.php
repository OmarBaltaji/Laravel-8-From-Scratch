<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post 
// extends Model
{
    // use HasFactory;

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title = null, $excerpt = null, $date = null, $body = null, $slug = null)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() 
    {
        // $files = File::files(resource_path("posts"));
        // return array_map(fn($file) => $file->getContents(), $files);

        return cache()->rememberForever('posts.all', fn() =>
            collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug,
            ))
            ->sortByDesc('date')
        );

        /* My Code */
        // $posts = [];
        // $local_posts = glob(resource_path("posts") . '/*');
        // foreach($local_posts as $local_post) {
        //     $posts[] = file_get_contents($local_post);
        // }
        // return $posts;
    }

    public static function find($slug) 
    {   
        // Of all the blog posts, find the one with a slug that matches the one that was requested
        return static::all()->firstWhere('slug', $slug);
        
        // if(!file_exists($path = resource_path("posts/{$slug}.html"))) {
        //     // abort(404);
        //     throw new ModelNotFoundException();
        // }

        // // now()->addMinutes(20)
        // return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));
    }

    public static function findOrFail($slug) 
    {   
        // Of all the blog posts, find the one with a slug that matches the one that was requested
        $post = static::find($slug);

        if(! $post) {
            throw new ModelNotFoundException();
        }
        
        return $post;
    }
}
