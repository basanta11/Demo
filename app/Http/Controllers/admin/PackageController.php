<?php

namespace App\Http\Controllers\admin;

use App\category;
use App\Http\Controllers\Controller;
use App\package;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $cat_id=$request->input('cat_id');
        $load=$request->input('load');

       $query = package::eloquentQuery($sortBy, $orderBy, $searchValue);
       if (isset($cat_id)) {
         $query->where('parent_id',$cat_id);

       }
       // if($load=="true"){
       //     $query->where('parent_id',null);
       // }
       
$result=$query->paginate($length);
foreach($result as $r){
$r->type=category::findorfail($r->category_id)->name;
}
       return new DataTableCollectionResource($result);
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
        $this->validate($request, [
            'name' => 'required',
            
        ]);
    
        package::create($request->all());
        return response()->json(['SucessFully Created'=>'success'],200);
      
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, package $package)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        $package->update($request->all());
        return response()->json(['SucessFully Updated'=>'success'],200);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(package $package)
    {
        //
    }
    
}
