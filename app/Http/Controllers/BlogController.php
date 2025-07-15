<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;

class BlogController extends Controller
{
    
    public function index()
    {
        $blogs = Blog::with('category', 'user')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('category', 'user')->findOrFail($id);
        return view('blog.show', compact('blog'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:blog_categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['user_id'] = auth()->id();

        Blog::create($data);

        return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:blog_categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($data);

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::with('category', 'user')
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->latest()
            ->paginate(10);

        return view('blog.search', compact('blogs', 'query'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        return response()->json(['url' => asset('storage/' . $path)]);
    }

    
    public function category($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blogs = $category->blogs()->with('user')->latest()->paginate(10);
        return view('blog.category', compact('category', 'blogs'));
    }

    public function indexPublic($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $blogs = Blog::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('blog.public.index', compact('blogs', 'username'));
    }

    public function showPublic($username, $id)
    {
        $user = User::where('username', $username)->firstOrFail();
        $blog = Blog::with('category')->where('user_id', $user->id)->findOrFail($id);

        return view('blog.public.show', compact('blog', 'username'));
    }
}
