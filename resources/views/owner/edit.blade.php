@extends('layouts.app')

@section('content')

<div class="container">

<h1>Edit new Owner</h1>

    <div class="errors">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
    <form method="POST" action="{{ route('owner.update', [$owner])}}">
        @csrf
        <div class="form-group">
            <label for="owner_name">Name</label>
            <input class="form-control @error('owner_name') is-invalid @enderror" type='text' name='owner_name' value="{{$owner->name}}" />
            @error('owner_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="owner_surname">Surname</label>
            <input class="form-control @error('owner_surname') is-invalid @enderror" type='text' name='owner_surname' value="{{$owner->surname}}" />
            @error('owner_surname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="owner_email">Email</label>
            <input class="form-control @error('owner_email') is-invalid @enderror" type='text' name='owner_email' value="{{$owner->email}}" />
            @error('owner_email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="owner_phone">Phone</label>
            <input class="form-control @error('owner_phone') is-invalid @enderror" type='text' name='owner_phone' value="{{$owner->phone}}" />
            @error('owner_phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>     
            

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@endsection

