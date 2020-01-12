<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Post;
use App\socialLinks;
use App\Comment;
use App\SiteDetail;
use App\Pages;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $data = array(
                'pageTitle' =>'Posts',
                'posts' => Post::where('post_status', 'active')->paginate(8),
                'topPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('views'),
                'latestPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('id'),
                'categories' => Category::all(),
                'socialLinks' => socialLinks::all(),
                'SiteDetails' => SiteDetail::first(),
                'Pages' => Pages::all()->where('page_status', 'active')->take(4)->sortByDesc('id'),

        );

        return view('fontend.posts', $data);
    }


    
    public function show($post)
    {
       $data = array(
                'pageTitle' =>'Posts',
                'post' => Post::where('post_status', 'active')->where('post_slug', $post)->firstOrFail(),
                'nextPost' => Post::where('post_status', 'active')->where('id', '>', Post::where('post_status', 'active')->where('post_slug', $post)->first()->id)->orderBy('id')->first(),
                'prevPost' => Post::where('post_status', 'active')->where('id', '<', Post::where('post_status', 'active')->where('post_slug', $post)->first()->id)->orderBy('id', 'DESC')->first(),
                'topPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('views'),
                'latestPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('id'),
                'categories' => Category::all(),
                'socialLinks' => socialLinks::all(),
                'SiteDetails' => SiteDetail::first(),
                'Pages' => Pages::all()->where('page_status', 'active')->take(4)->sortByDesc('id'),

        );
       //post view update
       $oldView= Post::where('post_status', 'active')->where('post_slug', $post)->firstOrFail()->views;
       Post::where('post_slug', $post)->update([
            'views' => $oldView + 1,
       ]);

        return view('fontend.post', $data); 
    }
    public function addComment(Request $request, $id){
        //store comment to  db
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::User()->id,
            'post_id' => $id,
            'content' => $request->comment,
        ]);
        $slug= Post::where('id',$id)->where('post_status', 'active')->firstOrFail()->post_slug;

        if ($comment) {
           return redirect('post/'.$slug)->with('success','comment created successfully..:)');
        }
        
        return redirect('post/'.$slug)->with('error','Something wrong..!!');


    }

    public function deleteComment($id)
    {   
        $post_id= Comment::where('id', $id)->firstOrFail()->post_id;
        $slug= Post::where('id',$post_id)->where('post_status', 'active')->firstOrFail()->post_slug;
        if (Comment::where('id', $id)->where('user_id', Auth::User()->id)) {
           $deleteCom= Comment::find($id)->update([
                'status' =>'draft',
           ]);
           if ($deleteCom) {
               return redirect('post/'.$slug)->with('success','comment deleted successfully..:)');
           }
           
           return redirect('post/'.$slug)->with('error','Something wrong..!!');
        }
        
        return redirect('post/'.$slug)->with('error','Something wrong..!!');
    }

   
    
}
