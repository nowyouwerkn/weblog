<?php

namespace Nowyouwerkn\WeBlog\Controllers;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use Image;
use Str;

use Nowyouwerkn\WeBlog\Models\Category;
use Nowyouwerkn\WeBlog\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->orWhere('parent_id', NULL)->paginate(15);
        $categories_all = Category::all()->count();

        return view('weblog::back.categories.index')->with('categories', $categories)->with('categories_all', $categories_all);
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->orWhere('parent_id', NULL)->paginate(10);

        return view('weblog::back.categories.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        //Validar
        $this -> validate($request, array(
            'name' => 'required|max:255',
        ));

        // Guardar datos en la base de datos
        $check_if_exists = Category::where('name', $request->name)->first();

        // Guardar datos en la base de datos
        $category = new Category;

        $category->name = $request->name;
        if (empty($check_if_exists)) {
            $category->slug = Str::slug($request->name, '-');
        }else{

            if ($request->parent_id == 0) {
                // Mensaje de session
                Session::flash('error', 'Esa categoría ya existe.');

                // Enviar a vista
                return redirect()->back();
            }else{
                $parent_name = Category::where('id', $request->parent_id)->first();

                $category->slug = Str::slug(($parent_name->name . ' ' . $request->name), '-');
            }
            
        }
        
        $category->parent_id = $request->parent_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::slug( $request->name , '-') . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/categories/' . $filename);

            Image::make($image)->resize(1280,null, function($constraint){ $constraint->aspectRatio(); })->save($location);

            $category->image = $filename;
        }

        $category->save();

        // Notificación
        $type = 'Colección';
        $by = Auth::user();
        $data = 'creó una nueva colección con el nombre:' . $category->name;

        $this->notification->send($type, $by ,$data);

        // Mensaje de session
        Session::flash('exito', 'Elemento guardado correctamente en la base de datos.');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('weblog::back.categories.show')->with('category', $category);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('weblog::back.categories.show')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        //Validar
        $this -> validate($request, array(
            'name' => 'required|max:255',
        ));

        // Guardar datos en la base de datos
        $category = Category::find($id);
        
        $category->name = $request->name;
        
        if (empty($check_if_exists)) {
            $category->slug = Str::slug($request->name, '-');
        }else{

            if ($request->parent_id == 0) {
                // Mensaje de session
                Session::flash('error', 'Esta categoría ya existe.');

                // Enviar a vista
                return redirect()->back();
            }else{
                $parent_name = Category::where('id', $request->parent_id)->first();

                $category->slug = Str::slug(($parent_name->name . ' ' . $request->name), '-');
            }
            
        }
        
        $category->parent_id = $request->parent_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::slug( $request->name , '-') . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/categories/' . $filename);

            Image::make($image)->resize(1280,null, function($constraint){ $constraint->aspectRatio(); })->save($location);

            $category->image = $filename;
        }

        $category->save();

        // Notificación
        $type = 'Colección';
        $by = Auth::user();
        $data = 'editó una colección con el nombre:' . $category->name;

        $this->notification->send($type, $by ,$data);

        // Mensaje de session
        Session::flash('success', 'Se guardó tu categoría exitosamente en la base de datos.');

        // Enviar a vista
        return redirect()->back();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $products = Product::where('category_id', $category->id)->get();

        foreach ($products as $product) {
            $product->subCategory()->detach();
            $product->category_id = NULL;
            $product->status = 'Borrado';

            $product->save();
        }
            
        foreach($category->children as $sub){
            $sub->delete();
        }

        // Notificación
        $type = 'Colección';
        $by = Auth::user();
        $data = 'eliminó la colección:' . $category->name;

        $this->notification->send($type, $by ,$data);

        $category->delete();

        Session::flash('success', 'Elemento eliminado correctamente de la base de datos.');

        return redirect()->route('categories.index');
        
    }
}
