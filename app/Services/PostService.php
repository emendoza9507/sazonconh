<?php

namespace App\Services;

use App\Models\Post;


class PostService
{
    public function getPosts()
    {
        return Post::all();
    }

    public function getPostBySlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }

    public function getPublishedPosts()
    {
        return Post::published()->orderBy('created_at', 'desc');
    }

    public function getLastPosts($limit = 3, $published = true)
    {
        return Post::orderBy('created_at', 'desc')->limit($limit)->when($published, function ($query) {
            return $query->where('is_published', true);
        })->get();
    }
}
