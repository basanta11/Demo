@extends('dashboard.base')

@section('content')

<loading 
:active.sync="$root.mainLoading"
>
</loading>  
<router-view></router-view>


@endsection

@section('javascript')


@endsection
