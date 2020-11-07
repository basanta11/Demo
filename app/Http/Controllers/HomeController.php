<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
   public function index()
   {
     return view('home');
  }
  public function any(){
  
    $user=Auth::User();
    if($user){
    if($user->hasRole('admin')){
      return view('dashboard.homepage');
    }
    
    }
      else
      {
        return view('errors.404');
    }
  }
  public function upload(Request $request){
    foreach($request->all() as $index=>$value)
    $path = Storage::disk('public')->put( 'ok/', $value );
	// Get stored file name
	$fileName = explode( 'public/', $path );
  // File nameasas

  } 
}
