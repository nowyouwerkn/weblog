<?php

namespace Nowyouwerkn\WeBlog\Controllers;
use App\Http\Controllers\Controller;

use View;
use Session;
use Auth;
use Carbon\Carbon;

/* E-commerce Models */
use Config;
use Mail;

/* WerknHub */
use Nowyouwerkn\WerknHub\Models\SiteTheme;
use Nowyouwerkn\WerknHub\Models\LegalText;
use Nowyouwerkn\WerknHub\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/* Notificaciones */
use Nowyouwerkn\WerknHub\Controllers\NotificationController;

/* Facebook Events API Conversion */
use Nowyouwerkn\WerknHub\Services\FacebookEvents;

/* WeBlog */
use Nowyouwerkn\WeBlog\Models\Post;
use Nowyouwerkn\WeBlog\Models\Category;
use Nowyouwerkn\WeBlog\Models\PostComment;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    private $notification;
    private $theme;

    public function __construct()
    {
        $this->notification = new NotificationController;
        $this->theme = new SiteTheme;
    }
    
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
