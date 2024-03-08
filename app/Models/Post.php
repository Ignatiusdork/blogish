<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {

            //find all the files in the posts directory and collect them into a collection, loop over
            //the items and for each file parse it to a document, once you have a collection of the
            //documents, loop over the second tym into a Post object and finally pass to view

            return collect(File::files(resource_path('posts')))
            ->map(function($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($documents) {
                return new Post(
                    $documents->title,
                    $documents->excerpt,
                    $documents->date,
                    $documents->body(),
                    $documents->slug
                );
            })->sortByDesc('date');
        //ddd($posts);
    }

    public static function find($slug) {
        // of all the blog posts, find the one with a slug that matches the one that is requested

        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
