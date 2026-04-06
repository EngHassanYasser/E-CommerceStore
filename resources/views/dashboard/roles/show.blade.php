@extends('layouts.dashboard')

@section('title',$category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

<base href='/public'>
 @section('content')
     <table class="table">
        <thead>
            <tr>
                <td>Image</td>
                <td>Name</td>
                <td>store</td>
                <td>Created At</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($category->products as $Product)
            <tr>
            <td>
                <img src="{{ asset('storage/images_folder/'.$Product->image) }}" />
            </td>
            <td>{{ $Product->name }}</td>
            <td>{{ $Product->store->name}}</td>
            <td>{{ $Product->created_at }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="8">No products Found</td>
          </tr>
          @endforelse
        </tbody>
    </table>
@endsection