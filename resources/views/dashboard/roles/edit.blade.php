@extends('layouts.dashboard')

<base href='/public'>
 @section('content')
<form action="{{ route("roles.update",$role->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
   @include('dashboard.roles._form',['button_label' =>'update'])
</form>
@endsection