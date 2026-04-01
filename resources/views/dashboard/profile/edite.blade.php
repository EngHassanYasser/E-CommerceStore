@extends('layouts.dashboard')

@section('title','Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PATCH')

<!-- First & Last Name -->
<div class="row mb-3">

<div class="col-md-6">
<label class="form-label">First Name</label>

<input 
type="text"
name="first_name"
class="form-control"
value="{{ old('first_name',$user->profile->first_name ?? '') }}">
</div>

<div class="col-md-6">
<label class="form-label">Last Name</label>

<input 
type="text"
name="last_name"
class="form-control"
value="{{ old('last_name',$user->profile->last_name ?? '') }}">
</div>

</div>


<!-- Birthday & Gender -->
<div class="row mb-3">

<div class="col-md-6">
<label class="form-label">Birthday</label>

<input 
type="date"
name="birth_date"
class="form-control"
value="{{ old('birth_date',$user->profile->birth_date ?? '') }}">
</div>


<div class="col-md-6">

<label class="form-label d-block">Gender</label>

<div class="form-check form-check-inline">

<input 
class="form-check-input"
type="radio"
name="gender"
value="male"

{{ old('gender',$user->profile->gender ?? '') == 'male' ? 'checked' : '' }}>

<label class="form-check-label">Male</label>

</div>


<div class="form-check form-check-inline">

<input 
class="form-check-input"
type="radio"
name="gender"
value="female"

{{ old('gender',$user->profile->gender ?? '') == 'female' ? 'checked' : '' }}>

<label class="form-check-label">Female</label>

</div>

</div>

</div>



<!-- Street Address, City, State -->
<div class="row mb-3">

<div class="col-md-4">

<label class="form-label">Street Address</label>

<input 
type="text"
name="street_address"
class="form-control"
value="{{ old('street_address',$user->profile->street_address ?? '') }}">

</div>


<div class="col-md-4">

<label class="form-label">City</label>

<input 
type="text"
name="city"
class="form-control"
value="{{ old('city',$user->profile->city ?? '') }}">

</div>


<div class="col-md-4">

<label class="form-label">State</label>

<input 
type="text"
name="state"
class="form-control"
value="{{ old('state',$user->profile->state ?? '') }}">

</div>

</div>



<!-- Postal Code, Country, Locale -->
<div class="row mb-3">


<div class="col-md-4">

<label class="form-label">Postal Code</label>

<input 
type="text"
name="postal_code"
class="form-control"
value="{{ old('postal_code',$user->profile->postal_code ?? '') }}">

</div>



<div class="col-md-4">

<label class="form-label">Country</label>

<select class="form-select" name="country">

@foreach ($countries as $code => $country)

<option 
value="{{ $code }}"

{{ old('country',$user->profile->country ?? '') == $code ? 'selected' : '' }}>

{{ $country }}

</option>

@endforeach

</select>

</div>



<div class="col-md-4">

<label class="form-label">Locale</label>

<select class="form-select" name="locale">

@foreach ($locales as $code => $locale)

<option 
value="{{ $code }}"

{{ old('locale',$user->profile->locale ?? '') == $code ? 'selected' : '' }}>

{{ $locale }}

</option>

@endforeach

</select>

</div>

</div>



<button type="submit" class="btn btn-primary">
Save
</button>

</form>

@endsection