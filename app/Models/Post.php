<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title, $excerpt, $date, $body) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }
    
    public static function all() {
        $files = File::files(resource_path("posts/"));

        //array_map is a kind of loop that returns a new array
        return array_map(function ($file) {
            return $file->getContents();
        }, $files);

    }

    public static function find($slug) {
        // build up a path and check if it exist
        if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        // cach the page into memory so we don't have to read from folder everytime
        //return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

        return cache()->remember("posts.{$slug}", 1200, function() use ($path) {
            return file_get_contents($path);
        });
    }
}
