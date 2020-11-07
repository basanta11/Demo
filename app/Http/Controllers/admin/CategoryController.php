<?php

namespace App\Http\Controllers\admin;

use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;


class CategoryController extends Controller
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

        $query = Category::eloquentQuery($sortBy, $orderBy, $searchValue);
        if (isset($cat_id)) {
          $query->where('parent_id',$cat_id);

        }
        // if($load=="true"){
        //     $query->where('parent_id',null);
        // }
        
$result=$query->paginate($length);
foreach($result as $q){
    $parent=$q->parent_id;
    if($parent){
        $name=null;

   while($parent != null){
        $value=category::where('id',$parent)->first();
$name= $name."  " . "->" . "  " . $value->name;
$parent=$value->parent_id;
    }
}

    
else{
    $name="-";
}
    $q->parent_name=$name;

}
        return new DataTableCollectionResource($result);
        

    }
    public function getOptions(){
        $data=Category::select('name','id')->get();
        foreach($data as $d){
            $d->value=$d->id;
            $d->text=$d->name;

        }
        return response()->json($data);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     }

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
    
        Category::create($request->all());
        return response()->json(['SucessFully Created'=>'success'],200);
      
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        $category->update($request->all());
        return response()->json(['SucessFully Updated'=>'success'],200);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
    public function selectChild( $id ) {
		$categories = Category::where( 'id', $id )->first(); //rooney

		$categories = $this->addRelation( $categories );

		return $categories;

	}

	public function addRelation( $categories ) {

		$categories->map( function ( $item, $key ) {

			$sub = $this->selectChild( $item->id );

			// return $item = array_add( $item, 'subCategory', $sub );

		} );

		return $categories;
	}
}
