@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Enter new task</h1>

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
    <form method="POST" action="{{ route('task.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="task_title">Title</label>
            <input class="form-control @error('task_title') is-invalid @enderror" type='text' name='task_title' value="{{ old('task_title') }}" />
            @error('task_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="task_description">Description</label>
            <textarea class="form-control @error('task_description') is-invalid @enderror" name='task_description'>
            {{ old('task_description') }}
            </textarea>
            @error('task_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="task_startDate">Start Date</label>
            <input class="form-control @error('task_startDate') is-invalid @enderror" type='date' name='task_startDate' value="{{ old('task_startDate') }}" />
            @error('task_startDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="task_endDate">End Date</label>
            <input class="form-control @error('task_endDate') is-invalid @enderror" type='date' name='task_endDate' value="{{ old('task_endDate') }}" />
            @error('task_endDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="task_ownerId">Task Owner</label>
            <select class="form-control @error('task_ownerId') is-invalid @enderror" name="task_ownerId">
                @foreach ($owners as $owner)
                <option value="{{$owner->id}}">{{$owner->name}} {{$owner->surname}}</option>
                @endforeach
            </select>
            @error('task_ownerId')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="task_logo">Task Logo</label>
            <input class="form-control @error('task_logo') is-invalid @enderror" type="file" name="task_logo" autofocus >
            @error('task_logo')
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