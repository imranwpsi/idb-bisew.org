<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getBanner()
    {
        return $banner = Banner::orderBy('id','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:191',
            'desc' => 'required',
            'url' => 'required|max:191'
        ]);

        $banner = new Banner();
        $bannerinfo= $banner->first();
        if (empty($bannerinfo)) {
            $banner->title = $request->title;
            $banner->desc = $request->desc;
            $banner->url = $request->url;
            $banner->save();
            return $banner;
       }else{
           return response(['error'=>'Banner take just one item']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return Banner::where('id',$banner->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request,[
            'title' => 'required|max:191',
            'desc' => 'required',
            'url' => 'required|max:191'
        ]);

        $banner = Banner::find($request->id);
        $banner->title = $request->title;
        $banner->desc = $request->desc;
        $banner->url = $request->url;
        $banner->save();
        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        banner::where('id',$banner->id)->delete();
    }
}
