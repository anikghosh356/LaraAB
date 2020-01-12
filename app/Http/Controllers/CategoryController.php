<?php

namespace App\Http\Controllers;

use App\Category;
use App\socialLinks;
use App\Pages;
use App\SiteDetail;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = array(
            'pageTitle' => 'Create New Category ',
            'categories' => Category::all(),

        );
        return view('admin.categories', $data);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'cat_name' => 'required|max:255',
        ]);

        $Category = Category::create([
            'user_id' => Auth::User()->id,
            'category_name' => $request->cat_name,
        ]);
        if ($Category) {
           return redirect('admin/categories')->with('success','Category created successfully..:)');
        }
        
        return redirect('admin/categories')->with('error','Something wrong..!!');
    }

   
    public function posts($id, $catName)
    {
        $data = array(
                'pageTitle' =>'Posts In '.$catName,
                'posts' => Post::where('post_status', 'active')->where('category_id', $id)->paginate(8),
                'topPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('views'),
                'latestPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('id'),
                'categories' => Category::all(),
                'socialLinks' => socialLinks::all(),
                'SiteDetails' => SiteDetail::first(),
                'Pages' => Pages::all()->where('page_status', 'active')->take(4)->sortByDesc('id'),

        );

        return view('fontend.posts', $data);
    }

    
    public function edit($id)
    {
        $data = array(
            'pageTitle' => 'Edit Category ',
            'categories' => Category::all(),
            'category' => Category::find($id),
        );
        return view('admin.categoryEdit', $data);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_name' => 'required|max:255',
        ]);

        $Category = Category::where('id', $id)->update([
            'category_name' => $request->cat_name,
        ]);
        if ($Category) {
           return redirect('admin/categories')->with('success','Category updated successfully..:)');
        }
        
        return redirect('admin/categories')->with('error','Something wrong..!!');
    }

    
    public function delete($id)
    {
       $Category= Category::find($id)->delete();

        if ($Category) {
            return redirect('admin/categories')->with('success','Category delete successfully..:)');
        }
        return redirect('admin/categories')->with('error','Something wrong..!!');
    }
}
