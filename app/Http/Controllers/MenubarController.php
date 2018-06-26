<?php

namespace App\Http\Controllers;
use App\Http\Requests\MenubarRequest;
use App\Menubar;
use App\Childmenu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MenubarController extends Controller
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

    public function getMenu()
    {   
        return $menubar = Menubar::with('childmenu')->get();
        //$menu = Menubar::orderBy('sort_order','ASC')->get();
        //return ['menubar'=>$menubar,'menu'=>$menu];
    }

    public function getClildmenu()
    {
        return $chlidmenu = Childmenu::orderBy('sort_order','ASC')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        if(isset($request->parent_id)){
            $req1=$request->sort_order;
            $req2=$request->parent_id;
            $this->validate($request,[
                'name' => 'required|max:191',
                'url' => 'required|max:191',
                'sort_order' => [
                    'required',Rule::unique('childmenus')->where(function($s) use ($req1,$req2){
                    return $s->where('sort_order',$req1)->where('parent_id',$req2);
                    })
                ],
            ]);

            $childmenu = new Childmenu;
            $childmenu->name = $request->name;
            $childmenu->url = $request->url;
            $childmenu->parent_id = $request->parent_id;
            $childmenu->sort_order = $request->sort_order;
            $childmenu->is_active = $request->is_active;
            $childmenu->save();
        }
        else
        {
            $this->validate($request,[
                'name' => 'required|max:191',
                'url' => 'max:191',
                'sort_order' => 'required|max:191|unique:menubars'
            ]);
            $menubar = new Menubar;
            $menubar->name = $request->name;
            $menubar->url = $request->url;
            $menubar->sort_order = $request->sort_order;
            $menubar->is_active = $request->is_active;
            $menubar->save();
            return $menubar;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Menubar  $menubar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$parent_id)
    {

        return Childmenu::orderBy('sort_order','ASC')->where('parent_id',$parent_id)->get();


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menubar  $menubar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$parent_id)
    {
        return Menubar::where('id',$parent_id)->get();
    }

    public function editClildmenu(Request $request,$child_id)
    {
        return Childmenu::where('id',$child_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menubar  $menubar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(isset($request->parent_id)){
            $req1=$request->sort_order;
            $req2=$request->parent_id;
            $req3=$request->id;
            $this->validate($request,[
                'name' => 'required|max:191',
                'url' => 'required|max:191',
                'sort_order' => [
                    'required',Rule::unique('childmenus')->ignore($req3)->where(function($s) use ($req1,$req2){
                    $s->where('sort_order',$req1)->where('parent_id',$req2);
                    })
                ],
            ]);

            $childmenu = Childmenu::find($request->id);
            $childmenu->name = $request->name;
            $childmenu->url = $request->url;
            $childmenu->parent_id = $request->parent_id;
            $childmenu->sort_order = $request->sort_order;
            $childmenu->is_active = $request->is_active;
            $childmenu->save();
            return $childmenu;
        }
        else
        {
            $this->validate($request,[
                'name' => 'required|max:191',
                'url' => 'max:191',
                'sort_order' => 'required|max:191|unique:menubars,sort_order,'.$request->id
            ]);
            $menubar = Menubar::find($request->id);
            $menubar->name = $request->name;
            $menubar->url = $request->url;
            $menubar->sort_order = $request->sort_order;
            $menubar->is_active = $request->is_active;
            $menubar->save();
            return $menubar;
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menubar  $menubar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menubar $menubar)
    {
       
       
      if(Childmenu::where('parent_id', $menubar->id)->count()<1) {
        Menubar::where('id',$menubar->id)->delete();
        return response(["success"=>"delete successfully"]);
      }
      else{
        return response(["error"=>"you have to delete child first"]);
      }
      
      
        
    }

    public function childmenudelete($childMenuId)
    {
        Childmenu::where('id',$childMenuId)->delete();
    }
}
