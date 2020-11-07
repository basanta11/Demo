<?php

namespace App\Http\Controllers\business;

use App\BusinessProfile;
use App\BusinessProfileHours;
use App\BusinessProfileSocial;
use App\Helpers\Image\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(Request $request )
    {
        $id=auth()->id();

        $data=BusinessProfile::where('user_id',$id)->first();
$data->coordinates=[];
$coordinates['lat']=(float)$data->latitude;
$coordinates['lng']=(float)$data->longitude;
$data->coordinates=$coordinates;
$features=[];
foreach($data->features as $f){
$features['name']=$f->name;
}
$opening=$data->hours()->where('type','opening')->first()->toArray();
    foreach($opening as  $key=>$value){
        $name=$key.'_'.'opening';
        $data->$name=$value;
}
$closing=$data->hours()->where('type','closing')->first()->toArray();
    foreach($closing as  $key=>$value){
        $name=$key.'_'.'closing';
        $data->$name=$value;
}

 $link=$data->social()->pluck('value','key')->toArray();
foreach($link as $key=>$value){
$data->$key=$value;
}
$data->categories=$data->categories()->get();

foreach($data->categories as $d){
    $d->value=$d->id;
    $d->text=$d->name;

}      return response()->json($data);

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
        $id=auth()->id();
        // dd($request->all());
        $profile = BusinessProfile::updateOrCreate(['user_id'=>$id],$request->only(['name','address', 'area_id','description','tags', 'email', 'phone', 'website']));
        $profile->latitude=$request->coordinates['lat'];
$profile->longitude=$request->coordinates['lng'];
$profile->update();

$profile->features()->delete();
if(request('features')){
foreach(request('features') as $data){
    $profile->features()->create(['name'=>$data['name']]);
}
}

       $openingHours= BusinessProfileHours::updateOrCreate(
           ['business_id'=>$profile->id,'type'=>'opening'],
       [
           'sunday'=>request('sunday_opening'),
           'monday'=>request('monday_opening'),
           'tuesday'=>request('tuesday_opening'),
           'wednesday'=>request('wednesday_opening'),
           'thrusday'=>request('thrusday_opening'),
           'friday'=>request('friday_opening'),
           'saturday'=>request('saturday_opening'),


    ]);
    
    $closingHours= BusinessProfileHours::updateOrCreate(
        ['business_id'=>$profile->id,'type'=>'closing'],
    [
        'sunday'=>request('sunday_closing'),
        'monday'=>request('monday_closing'),
        'tuesday'=>request('tuesday_closing'),
        'wednesday'=>request('wednesday_closing'),
        'thrusday'=>request('thrusday_closing'),
        'friday'=>request('friday_closing'),
        'saturday'=>request('saturday_closing'),


 ]
);
$social=$request->only(['facebook','twitter','instagram','linkedin']);

foreach($social as $key=>$value){
    BusinessProfileSocial::updateOrCreate( [ 'key' => $key,'business_id'=>$profile->id ], [ 'value' => $value ] );
}
$categories=[];
foreach($request->categories as $cat){
    $categories[]=$cat['id'];
}
$profile->categories()->sync($categories);
    return response()->json(['success'=>'Saved'],200);

    }
    public function image(Request $request)
    {
     $id=auth()->id();

        $image          = $request->file( 'file' );
		$tmpPath        = $id;
		$checkDirectory = '/uploads/profile/images/' .  $tmpPath ;

		$dbPath = $checkDirectory . '/' . $image->getClientOriginalName();

		$imageService = new ImageService();
        $image        = $imageService->upload( $image, $checkDirectory );
        $path=$image->relativePath;

$businessProfile=BusinessProfile::where('user_id',$id)->first();
$businessProfile->images()->create(['path'=>$path]);
return response()->json(['success'=>'Saved'],200);


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessProfile  $businessProfile
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessProfile $businessProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessProfile  $businessProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessProfile $businessProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessProfile  $businessProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessProfile $businessProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessProfile  $businessProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessProfile $businessProfile)
    {
        //
    }
}
