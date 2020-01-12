<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Auth;
use App\Post;
use App\Category;
use App\Comment;
use App\SiteDetail;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.home');
    }


    public function create()
    {
        //create post
        $data = array(
            'pageTitle' => 'Create New Post ',
            'categories' => Category::all(),  
        );
        return view('admin.createPost', $data);
    }


    public function store(Request $request)
    {   
        //validation
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
            'post_category' => 'required',
            'tags' => 'required',
            'post_thumbnail' => 'required|image|mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF,svg,SVG|max:5048',
        ]);

        //image
        $thumbnail = time().'.'.request()->post_thumbnail->getClientOriginalExtension();
        request()->post_thumbnail->move(public_path('img/temp'), $thumbnail);

        $img = Image::make('img/temp/'.$thumbnail);
        $img->crop(730, 390)->save('img/730x390/'.$thumbnail);
        $img->crop(350, 230)->save('img/350x230/'.$thumbnail);
        $img->crop(290, 134)->save('img/290x134/'.$thumbnail);

        $post = Post::create([
            'user_id' => Auth::User()->id,
            'post_title' => $request->post_title,
            'post_slug' => time(),
            'post_content' => $request->post_content,
            'tags' => $request->tags,
            'category_id' => $request->post_category,
            'post_thumbnail' => $thumbnail,
        ]);
        if ($post) {
           return redirect('admin/posts')->with('success','Post created successfully..:)');
        }
        
        return redirect('admin/posts')->with('error','Something wrong..!!');
        
    }

    public function posts()
    {
        // show all post with create , edit and delete button 
        //create post
        $data = array(
            'pageTitle' => 'All Posts ',
            'posts' => Post::all()->where('post_status','active'),
        );
        return view('admin.posts', $data);

    }


    public function edit($id)
    {
        //edit post 
        $post= Post::where('id', $id)->where('post_status','active')->first();
        $data = array(
            'pageTitle' => 'Edit Post',
            'categories' => Category::all(),
            'post' => $post

        );
        
        if ($post) {
           return view('admin.postedit', $data);
        }else{
            return redirect('admin/posts')->with('error','Something wrong..!!');
        }
        
    }

    public function update(Request $request, $id)
    {
        //update post
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
            'post_category' => 'required',
            'tags' => 'required',
        ]);
        if (request()->post_thumbnail != '') {
            //image
            $thumbnail = time().'.'.request()->post_thumbnail->getClientOriginalExtension();
            request()->post_thumbnail->move(public_path('img/temp'), $thumbnail);

            $img = Image::make('img/temp/'.$thumbnail);
            $img->crop(730, 390)->save('img/730x390/'.$thumbnail);
            $img->crop(350, 230)->save('img/350x230/'.$thumbnail);
            $img->crop(290, 134)->save('img/290x134/'.$thumbnail);

            $post = Post::where('id', $id)->update([
                'post_title' => $request->post_title,
                'post_content' => $request->post_content,
                'tags' => $request->tags,
                'category_id' => $request->post_category,
                'post_thumbnail' => $thumbnail,
            ]);
            
        }else{
            $post = Post::where('id', $id)->update([
                'post_title' => $request->post_title,
                'post_content' => $request->post_content,
                'tags' => $request->tags,
                'category_id' => $request->post_category,
            ]);
        }

        if ($post) {
               return redirect('admin')->with('success','Post updated successfully..:)');
            }
            
            return redirect('admin')->with('error','Something wrong..!!');
    }


    public function delete($id)
    {
        
        $post=Post::where('id', $id)->update([
            'post_status'=>'draft'
        ]);
        if ($post) {
            return redirect('admin/posts')->with('success','Post Deleted successfully..:)');
        }
        return redirect('admin/posts')->with('error','Something wrong..!!');
    }

    public function trash()
    {
        //create post
        $data = array(
            'pageTitle' => 'Trash ',
            'posts' => Post::all()->where('post_status','draft'),  
        );
        return view('admin.posttrash', $data);
    }

    public function restore($id)
    {
        $post= Post::where('id', $id)->update([
            'post_status'=>'active',
        ]);

        if ($post) {
            return redirect('admin/posts')->with('success','Post restored successfully..:)');
        }
        return redirect('admin/posts')->with('error','Something wrong..!!');
    }

    public function pDelete($id)
    {
        $post= Post::find($id)->delete();

        if ($post) {
            return redirect('admin/trash')->with('success','Post delete successfully..:)');
        }
        return redirect('admin/trash')->with('error','Something wrong..!!');
    }



    //site details part here 
    public function SiteDetails()
    {
        $data = array(
            'pageTitle' => 'Site Details ',
            'siteDetails' => SiteDetail::first(),  
        );
        return view('admin.SiteDetails', $data);
    }
    public function editSD()
    {
        $data = array(
            'pageTitle' => 'Site Details ',
            'siteDetails' => SiteDetail::first(),  
        );
        return view('admin.editSD', $data);
    }

    public function updateSD(Request $request)
    {
        if (SiteDetail::first() != '')
        {
            $request->validate([
                'site_name' => 'required|string|max:255',
                'site_tagline' => 'required|string|max:255',
                'short_about' => 'required',
            ]);
            $updateID= SiteDetail::first()->id;
            
            $updateSite = SiteDetail::where('id', $updateID)->update([
                'site_name' => $request->site_name,
                'site_tagline' => $request->site_tagline,
                'short_about' => $request->short_about,
            ]);
            if ($updateSite)
            {
                return redirect('admin/SiteDetails')->with('success','SiteDetails Updated successfully..:)');
            }
            return redirect('admin/SiteDetails')->with('error','Something wrong..!!');
        }
        return redirect('admin/SiteDetails')->with('error','Something wrong..!!');
    }

    public function CreatesiteSD()
    {   
        if (SiteDetail::first() == '') 
        {
            $data = array(
                'pageTitle' => 'Site Details ',
                 
            );
            return view('admin.CreatesiteSD', $data);
        }
        return redirect('admin/SiteDetails')->with('error','Something wrong..!!');
    }

    public function siteSDstore(Request $request)
    {
        if (SiteDetail::first() == '')
        {
            $request->validate([
                'site_name' => 'required|string|max:255',
                'site_tagline' => 'required|string|max:255',
                'short_about' => 'required',
            ]);
            
            $SiteDetail = SiteDetail::create([
                'user_id' => Auth::User()->id,
                'site_name' => $request->site_name,
                'site_tagline' => $request->site_tagline,
                'short_about' => $request->short_about,
            ]);
            if ($SiteDetail)
            {
                return redirect('admin/SiteDetails')->with('success','SiteDetails added successfully..:)');
            }
            return redirect('admin/SiteDetails')->with('error','Something wrong..!!');
        }
        return redirect('admin/SiteDetails')->with('error','Something wrong..!!');
    }

    //comments area 
    public function comments()
    {
        $data = array(
            'pageTitle' => 'All Comments',
            'comments' => Comment::all()->where('status', 'active'),

        );
        return view('admin.comments', $data);
    }

    public function dComment($id)
    {
        $Comment=Comment::where('id', $id)->update([
            'status'=>'draft'
        ]);
        if ($Comment) {
            return redirect('admin/comments')->with('success','comment Deleted successfully..:)');
        }
        return redirect('admin/comments')->with('error','Something wrong..!!');
    }
        //commnent trash 
    public function tComments()
    {
        $data = array(
            'pageTitle' => 'All trash Comments',
            'tComments' => Comment::all()->where('status', 'draft'),

        );
        return view('admin.tComments', $data);
    }
    public function commentR($id)
    {
        $Comment=Comment::where('id', $id)->update([
            'status'=>'active'
        ]);
        if ($Comment) {
            return redirect('admin/tComments')->with('success','comment restored successfully..:)');
        }
        return redirect('admin/tComments')->with('error','Something wrong..!!');
    }

    //profile actions 
    public function profileAction(){
        $data = array(
            'pageTitle' => 'Profile Actions', 
        );
        return view('admin.profileAction', $data);
    }
    public function changePassword(){
        $data = array(
            'pageTitle' => 'Change Password', 
        );
        return view('admin.changePassword', $data);
    }
    public function updatePass(Request $request){

        $request->validate([
                'oldPassword' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
        ]);
        $userId= Auth::User()->id;


        if (Hash::check($request['current-password'], Auth::User()->password))
        {
            $updatePass = User::where('id', $userId)->update([
            'password' =>  Hash::make($request->password),
            ]);
            if ($updatePass) 
            {
             return redirect('admin/profileAction')->with('success','password changed successfully..:)');
            }
            return redirect('admin/changePassword')->with('error','Something wrong..!!');

        }
        return redirect('admin/changePassword')->with('error','old password is not match..!!'); 
    }


}
