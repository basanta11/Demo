<?php

namespace App\Http\Controllers;

use App\category;
use App\FeildCategoryPivot;
use App\FeildOptions;
use App\Feilds;
use App\Helpers\PaginationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class FeildsController extends Controller
{
    use PaginationHelper;
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

        $query = Feilds::eloquentQuery($sortBy, $orderBy, $searchValue);


        $results = $query->paginate($length);
        foreach ($results as $result) {
            $result->required = $result->is_required == 1 ? "True" : "False";
        }
        return new DataTableCollectionResource($results);
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
        $data = Feilds::create($request->all());
        return response()->json(['SucessFully Updated' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feilds  $feilds
     * @return \Illuminate\Http\Response
     */
    public function show(Feilds $feilds)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feilds  $feilds
     * @return \Illuminate\Http\Response
     */
    public function edit(Feilds $feilds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feilds  $feilds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Feilds $feilds)
    {
        // dd($request->all());
        Feilds::where('id', $id)->update($request->all());
        return response()->json(['SucessFully Updated' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feilds  $feilds
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feilds $feilds, $id)
    {
        Feilds::where('id', $id)->delete();
       FeildOptions::where('feild_id',$id)->delete();
        return response()->json(['SucessFully Deleted' => 'success'], 200);
    }
    public function storeOptions(Request $request)
    {
        FeildOptions::create($request->all());
        return response()->json(['SucessFully Added' => 'success'], 200);
    }
    public function editOptions(Request $request, $id)
    {
        FeildOptions::where('id', $id)->update($request->all());
        return response()->json(['SucessFully Updated' => 'success'], 200);
    }
    public function deleteOptions(Request $request, $id)
    {
        FeildOptions::where('id', $id)->delete();

        return response()->json(['SucessFully Deleted' => 'success'], 200);
    }
    public function deleteCategories(Request $request, $id)
    {
        FeildCategoryPivot::where('id', $id)->delete();

        return response()->json(['SucessFully Deleted' => 'success'], 200);
    }
    public function getOptions(Request $request, $id)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = FeildOptions::eloquentQuery($sortBy, $orderBy, $searchValue)->where('feild_id', $id);


        $results = $query->paginate($length);
        return new DataTableCollectionResource($results);
    }
    public function addCategory(Request $request){

        $feild=Feilds::findorfail($request->feild_id);
$data=DB::table('category_feild')->where('feild_id',$request->feild_id)->where('category_id',$request->category_id)->first();
if($data){
    return response()->json(['Already Added' => 'success'], 200);

}      
$feild->categories()->attach($request->category_id);
        return response()->json(['SucessFully Added' => 'success'], 200);

    }
    public function getCategories(Request $request,$id){
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $data=FeildCategoryPivot::eloquentQuery($sortBy, $orderBy, $searchValue)->where('feild_id',$id);
       
    //    $data= $this->paginateHelper($data,$length);
       $data = $data->paginate($length);

foreach($data as $d){
  
    $d->cat_name=category::findorfail($d->category_id)->name;

} 
               
return new DataTableCollectionResource($data);
   
    }
}
