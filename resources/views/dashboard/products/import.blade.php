@extends('layouts.dashboard')

<base href='/public'>
 @section('content')
<form action="{{ route("products.import") }}" method="post" enctype="multipart/form-data">
    @csrf

   <div class="form-group">
        <label for="">Products Count</label>
      <input type="number" name="count">
      <button type="submit" class="btn btn-primary">Start Import ...</button>
    </div>
</form>
@endsection