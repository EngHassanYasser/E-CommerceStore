@extends('layouts.dashboard')

@section('title','roles')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">roles</li>
@endsection

 <base href="/public"> @section('content')

 <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <input type="text" name="name"  value = "{{ request('name') }}" placeholder="name" class="mx-2"/>
    <select name="status" class="form-control mx-2" >
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button type="submit" class="btn btn-dark mt-2">Search</button>
 </form>
 <div class="mb-5">
    <a href={{ route('roles.create') }} class="btn btn-sm btn-outline-primary">create</a>
    {{-- <a href={{ route('roles.trash') }} class="btn btn-sm btn-outline-secondary">Trashed</a> --}}
 </div>
 <x-alert type="success"/>
 <x-alert type="info"/>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Created At</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $Role)
            <tr>
            <td>{{ $Role->id }}</td>
            <td><a href="{{ route('roles.show',$Role->id) }}">{{ $Role->name }}</a></td>
            <td>{{ $Role->created_at }}</td>
            <td>
                <a href="{{ route('roles.edit',$Role->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('roles.destroy',$Role->id) }}" method="post">
                    @csrf
                    @method('delete')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4">No roles Found</td>
          </tr>
          @endforelse
        </tbody>
    </table>
    {{ $roles->withQueryString()->links() }}
@endsection