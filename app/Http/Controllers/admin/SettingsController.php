<?php

namespace App\Http\Controllers\admin;

use App\Helpers\FileUpload as HelpersFileUpload;
use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;
use App\Helpers\Helpers\FileUpload;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings=Settings::all()->pluck('value','key')->toArray();
         return response()->json($settings);
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
  foreach($request->all() as $input=>$value){
    
if($input=="logo" || $input=="fav_icon"){
    if( $request->hasFile('logo') || $request->hasFile('fav_icon')) {
     

        $configuration = Settings::where( 'key', $input )->first();

if($configuration){
    $deleteImage= new HelpersFileUpload();
        $deleteImage->deleteFile($configuration->value); 
}
        $file = $value;
        $uploadImage= new HelpersFileUpload();
        $path= $uploadImage->uploadFile($file ,'settings');

         $value =  $path;
}
  

    

  }
  Settings::updateOrCreate( [ 'key' => $input ], [ 'value' => $value ] );

}

    return response()->json(['success'=>'Saved'],200);
}

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        dd('dfds');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
