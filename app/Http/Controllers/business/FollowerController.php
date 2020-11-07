<?php

namespace App\Http\Controllers\business;

use App\BusinessProfile;
use App\FollowListing;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class FollowerController extends Controller
{
    use PaginationHelper ;
  
    public function getFollowers(Request $request){
        $length = $request->input('length');

$id=auth()->id();
$profile=BusinessProfile::where('user_id',$id)->first()->id;
$query=FollowListing::where('business_id',$profile)->get();

               
$result=$this->paginateHelper($query,$length);
foreach($result as $r){
$r->name=User::findorfail($r->user_id)->name;
}
return new DataTableCollectionResource($result);
    }
}
