<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['delete', 'trash', 'restore', 'permanentDelete']]);
    }

    public function index()
    {
        // $blogs = Blog::latest()->get();
        $blogs = Blog::where('status', 1)->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // validate
        $rules = [
            'title' => ['required', 'min:2', 'max:160'],
            'body' => ['required', 'min:2'],
        ];

        $this->validate($request, $rules);
        
        $input = $request->all();

        // meta stuff
        $input['slug'] = Str::slug($request->title);
        $input['metatitle'] = Str::limit($request->title, 55);
        $input['metadescription'] = Str::limit($request->title, 155); 


        // image uload
        if ($file = $request->file('featured_image'))
        {
            $name = uniqid() . $file->getClientOriginalName();
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;
        }

        // $blog = Blog::create($input);
        $blogByUser = $request->user()->blogs()->create($input);
        // sync with categories
        if ($request->category_id)
        {
            $blogByUser->category()->sync($request->category_id);
        }

        Session::flash('blog_created_message', 'Congratulations on creating a great blog!');
        
        return redirect('/blogs');
    }
    
    public function show(string $slug) {
        // $blog = Blog::findOrFail($id);
        $blog = Blog::whereSlug($slug)->first();
        return view('blogs.show', ['blog' => $blog]);
    }

    public function edit($id)
    {
        $categories = Category::latest()->get();
        $blog = Blog::findOrFail($id);

        $fc = array();
        foreach ($blog->category as $c)
        {
            $fc[] = $c->id - 1;
        }

        $filtered = Arr::except($categories, $fc);


        return view('blogs.edit', ['blog' => $blog, 'categories' => $categories, 'filtered' => $filtered]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $blog = Blog::FindOrFail($id);
        $blog->update($input);
        // sync with cateogries
        if ($request->category_id)
        {
            $blog->category()->sync($request->category_id);
        }
        return redirect('blogs');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('blogs');
    }

    public function trash()
    {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $blogToRestore = Blog::onlyTrashed()->findOrFail($id);
        $blogToRestore->restore($blogToRestore);
        return redirect('blogs');
    }

    public function permanentDelete($id)
    {
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);
        return redirect(route('blogs'));
    }
}
