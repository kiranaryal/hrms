<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Redirect;


class PostController extends Controller
{
    public function index()
    {if(auth()->user()->is_admin !=1){
        return redirect()->back();
    }
        //
        $data['posts'] = Post::orderBy('id','desc')->paginate(8);

        return view('posts.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {if(auth()->user()->is_admin !=1){
        return redirect()->back();
    }
        $post   = Post::Create(
            [
                'title' => $request->title,
                 'description' => $request->description
            ]
        );

        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { if(auth()->user()->is_admin !=1){
        return redirect()->back();
    }
        //
        $where = array('id' => $id);
        $post  = Post::where($where)->first();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { if(auth()->user()->is_admin !=1){
        return redirect()->back();
    }
        //
        $post = Post::where('id',$id)->delete();

        return response()->json($post);
    }
}
