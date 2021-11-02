<?php

namespace Nowyouwerkn\WeBlog\Controllers;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use Carbon\Carbon;

use Nowyouwerkn\WeBlog\Models\Post;
use Nowyouwerkn\WeBlog\Models\Category;
use Nowyouwerkn\WeBlog\Models\PostComment;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('created_at', 'desc')->paginate(6);

        return view('front.theme.' . $this->theme->get_name() . '.blog.index')
        ->with('posts', $posts);
    }

    public function detail($slug)
    {
        $post = Blog::where('slug', $slug)->first();
        $related_posts = Blog::where('slug', '!=', $slug)->take(3);

        return view('front.theme.' . $this->theme->get_name() . '.blog.detail')
        ->with('post', $post)
        ->with('related_posts', $related_posts);
    }

    public function authorList($author)
    {
        $author = User::find($author)->first();

        return view('front.theme.' . $this->theme->get_name() . '.blog.archive')
        ->with('author', $author);
    }

    public function rssFeed()
    {

    }
}
