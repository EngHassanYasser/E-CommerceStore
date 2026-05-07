@extends('layouts.dashboard')

<base href='/public'>
 @section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route("categories.update",$category->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
   @include('dashboard.categories._form',[
   'button_label' =>'update'
   ])
</form>
@endsection