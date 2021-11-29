<?php

namespace Nowyouwerkn\WeBlog\Controllers;
use App\Http\Controllers\Controller;

// Ayudantes
use Session;
use Auth;

// Modelos
use Nowyouwerkn\WeBlog\Models\Post;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);
        return view('weblog::back.posts.index')->with('posts', $posts);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //Validar
        $this -> validate($request, array(
            'name' => 'required|max:255',
        ));

        // Guardar datos en la base de datos
        $category = Category::create([
            'in' => $user->in,
            'info' => $request->info,
            'info_2' => $request->info_2,
            'info_3' => $request->info_3,
        ]);

        // Mensaje de session
        Session::flash('success', 'Your category was saved correctly in the database.');

        // Enviar a vista
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $variable = Post::find($id);
        $variable->delete();

        Session::flash('success', 'Se eliminó la información de manera exitosa.');
        return redirect()->back();
    }
}
