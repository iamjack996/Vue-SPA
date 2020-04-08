<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        Post $post
    )
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->getDataList([],[],'paginate',10);
        return $posts;
    }

    public function show(Post $post)
    {
        return $post;
    }
}
