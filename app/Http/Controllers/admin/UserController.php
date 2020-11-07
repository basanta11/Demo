<?php

namespace App\Http\Controllers\admin;

use App\BusinessProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    //

    public function getuser()
    {
        $user = User::all('id', 'name');

        return response()->json($user);
    }
    public function getRoles()
    {


        $roles = DB::table('roles')->select(['id', 'name'])->get();
        foreach ($roles as $d) {
            $d->value = $d->id;
            $d->text = $d->name;
        }
        return response()->json($roles);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:users,name',
            'email' => 'required|string|max:100|email|unique:users,email',
            'phone' => 'required|string|max:10||unique:users,phone',

            'role' => 'required',
            // 'active' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,

            'email' => $request->email,
            'phone' => $request->phone,

            'password' => Hash::make($request['password']),
            'is_active' => $request->is_active,
        ]);
        if ($request->role) {
            $user->roles()->attach($request['role']);
        }
        BusinessProfile::create(['name'=>$user->name,'user_id',$user->id]);
        return response()->json(['success' => 'User Saved'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:users,name,' . $id,
            'email' => 'required|string|max:100|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:10||unique:users,phone,'.$id,
           

        ]);
        if ($request->has('password')) {
            $request->validate([
                'password' => 'min:6|string|max:11|confirmed',
            ]);
        }

        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->phone = $request->phone;

        if ($request->has('password')) {
            $user->password = Hash::make($request['password']);
        }
        $user->update();
        if ($request->has('role')) {

        $user->roles()->sync($request['role']);
        }
        if( $request->hasFile('pp')) {
            $media = new Media();
            $media->upload( $user, $request->pp, '/uploads/users' );
        }
        return response()->json(['success' => 'User Updated'], 200);
    }


    public function index(Request $request)
    {

        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $cat_id = $request->input('cat_id');

        $query = User::eloquentQuery($sortBy, $orderBy, $searchValue);
           if (isset($cat_id)) {
             $query->whereHas('roles', function ($q) use ($cat_id) {
                $q->where('id', $cat_id);
           });
        }
        // if($load=="true"){
        //     $query->where('parent_id',null);
        // }

        $result = $query->paginate($length);

foreach($result as $r){
    $r->active=($r->is_active==1)?"Active":"Blocked";
    $r->role=$r->roles->pluck('id')->first();
    $r->r_name=$r->roles->pluck('name')->first();

}
        return new DataTableCollectionResource($result);
    }
    public function show(User $user)
    {
        //
    }
    public function getData(){
        $user=Auth::User();
        if($user->hasImage()){
        $user->image=$user->getImage()->smallUrl;
        }
        else{
            $user->image=url().'/static-images/default-avatar.png';
        }
        return response()->json($user);

    }
}
