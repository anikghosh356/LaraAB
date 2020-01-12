<?php

namespace App\Http\Controllers;

use App\socialLinks;
use Auth;
use Illuminate\Http\Request;

class SocialLinksController extends Controller
{
    
    public function index()
    {
         $data = array(
            'pageTitle' => 'Create New Social Link ',
            'socialLinks' => socialLinks::all()
        );
        return view('admin.socialLinks', $data);
    }

    
    public function store(Request $request)
    {
        //validation
        $request->validate([
            's_title' => 'required|string|max:255',
            'fa_class' => 'required',
            'url' => 'required',
        ]);

        $socialLink = socialLinks::create([
            'user_id' => Auth::User()->id,
            'title' => $request->s_title,
            'fa_class' => $request->fa_class,
            'url' => trim($request->url),
        ]);

        if ($socialLink) {
           return redirect('admin/socialLinks')->with('success','Social link created successfully..:)');
        }
        
        return redirect('admin/socialLinks')->with('error','Something wrong..!!');  
    }

    
    public function edit($id)
    {
        $data = array(
            'pageTitle' => 'Create New Social Link ',
            'socialLinks' => socialLinks::all(),
            'socialLink' => socialLinks::where('id', $id)->firstOrFail(),
        );
        return view('admin.socialLinksEdit', $data);
    }

    
    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            's_title' => 'required|string|max:255',
            'fa_class' => 'required',
            'url' => 'required',
        ]);

        $update = socialLinks::where('id', $id)->update([
            'title' => $request->s_title,
            'fa_class' => $request->fa_class,
            'url' => trim($request->url),
        ]);

        if ($update) {
           return redirect('admin/socialLinks')->with('success','Social link Updated successfully..:)');
        }
        
        return redirect('admin/socialLinks')->with('error','Something wrong..!!'); 
    }

    
    public function delete($id)
    {
        $socialLink= socialLinks::find($id)->delete();

        if ($socialLink) {
            return redirect('admin/socialLinks')->with('success','Social link delete successfully..:)');
        }
        return redirect('admin/socialLinks')->with('error','Something wrong..!!');
    }
}
