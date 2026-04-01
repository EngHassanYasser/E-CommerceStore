@extends('layouts.dashboard')

<base href='/public'>
 @section('content')
<form action="{{ route("products.store") }}" method="post" enctype="multipart/form-data">
    @csrf

    @if(session('info'))

    @endif
    @include('dashboard.products._form')
</form>
@endsection