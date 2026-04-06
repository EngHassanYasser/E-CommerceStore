@extends('layouts.dashboard')

<base href='/public'>
 @section('content')
<form action="{{ route("roles.store") }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.roles._form')
</form>
@endsection