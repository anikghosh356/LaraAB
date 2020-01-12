<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Pages;
use App\socialLinks;
use App\SiteDetail;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PagesController extends Controller
{


    public function index($pageName='home')
    {
        if ($pageName=='home') 
        {
            
        	
            $data = array(
                    'pageTitle' =>'home',
                    'randomPosts' => Post::orderBy(DB::raw('RAND()'))->take(8)->get(),
                    'topPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('views'),
                    'latestPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('id'),
                    'categories' => Category::all(),
                    'socialLinks' => socialLinks::all(),
                    'SiteDetails' => SiteDetail::first(),
                    'Pages' => Pages::all()->where('page_status', 'active')->take(4)->sortByDesc('id'),
            );


            return view('fontend.home', $data);

        }elseif (Pages::where('page_name', $pageName)->first()) 
        {
        	
            $data = array(
                    'pageTitle' =>'home',
                    'topPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('views'),
                    'latestPosts' => Post::all()->where('post_status', 'active')->take(4)->sortByDesc('id'),
                    'categories' => Category::all(),
                    'socialLinks' => socialLinks::all(),
                    'SiteDetails' => SiteDetail::first(),
                    'page' =>Pages::where('page_name', $pageName)->first(),
                    'Pages' => Pages::all()->where('page_status', 'active')->take(4)->sortByDesc('id'),
            );


            return view('fontend.page', $data);
        }else
        {
        	abort(404);
        }
    }



    //admin panel control
    public function pages()
    {

        $data = array(
            'pageTitle' => 'All Of Your Pages',
            'pages' => Pages::all()->where('page_status', 'active'), 
        );
        return view('admin.pages', $data);
    }

    public function create()
    {
        //create 
        $data = array(
            'pageTitle' => 'Create New Page',
        );
        return view('admin.pageCreate', $data);
    }
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'page_name' => 'required|string|max:255',
            'page_content' => 'required',
        ]);

        $page = Pages::create([
            'user_id' => Auth::User()->id,
            'page_name' => preg_replace('~[^\pL\d]+~u', '-', $request->page_name),
            'page_content' => $request->page_content,
        ]);

        if ($page) {
           return redirect('admin/pages')->with('success','Page created successfully..:)');
        }
        
        return redirect('admin/pages')->with('error','Something wrong..!!');   

    }
    public function edit($id)
    {
      
        $data = array(
            'pageTitle' => 'All Of Your Pages',
            'page' => Pages::where('id', $id)->first(),  
        );
        return view('admin.editPage', $data);
    }

    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            'page_name' => 'required|string|max:255',
            'page_content' => 'required',
        ]);

        $page = Pages::where('id', $id)->update([
            'page_name' => preg_replace('~[^\pL\d]+~u', '-', $request->page_name),
            'page_content' => $request->page_content,
        ]);

        if ($page) {
           return redirect('admin/pages')->with('success','Page updated successfully..:)');
        }
        
        return redirect('admin/pages')->with('error','Something wrong..!!');   

    }

    public function delete($id)
    {
        //
        $page=Pages::where('id', $id)->update([
            'page_status'=>'draft'
        ]);
        if ($page) {
            return redirect('admin/pages')->with('success','Page Deleted successfully..:)');
        }
        return redirect('admin/pages')->with('error','Something wrong..!!');
    }

    public function trash()
    {
        $data = array(
            'pageTitle' => 'Trash Can of Page',
            'pages' => Pages::all()->where('page_status', 'draft'),  
        );
        return view('admin.pageTrash', $data);
    }

    public function restore($id)
    {
        $page= Pages::where('id', $id)->update([
            'page_status'=>'active',
        ]);

        if ($page) {
            return redirect('admin/pageTrash')->with('success','Page restored successfully..:)');
        }
        return redirect('admin/pageTrash')->with('error','Something wrong..!!');
    }

    public function ppDelete($id)
    {
        $page= Pages::find($id)->delete();

        if ($page) {
            return redirect('admin/pageTrash')->with('success','page delete successfully..:)');
        }
        return redirect('admin/pageTrash')->with('error','Something wrong..!!');
    }

    public function logout () 
    {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
