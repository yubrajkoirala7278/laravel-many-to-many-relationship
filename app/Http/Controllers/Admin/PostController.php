<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Service\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;
    public function __construct()
    {
        $this->postService = new PostService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = $this->postService->fetchPost();
            $tags = Tag::all();
            return view('admin.posts.index', compact('posts','tags'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Category::all();
            $tags = Tag::all();
            return view('admin.posts.create', compact('categories', 'tags'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $this->postService->addService($request->validated());
            return redirect()->route('posts.index')->with('success', 'Post added successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            $categories = Category::all();
            $tags = Tag::all();
            $post = $this->postService->view($post);
            return view('admin.posts.show', compact('post','categories', 'tags'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        try {
            $categories = Category::all();
            $tags = Tag::all();
            $post = $this->postService->view($post);
            return view('admin.posts.edit', compact('post','categories', 'tags'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        try{
            $this->postService->updateService($request->validated(),$post);
            return redirect()->route('posts.index')->with('success','post updated successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try{
            $this->postService->deletePost($post);
            return back()->with('success','Post deleted successfully');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
