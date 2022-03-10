@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Owners list</h1>

    @if (session()->has('error_message'))
    <div class="alert alert-danger">Delete is not possible while owner has tasks.</div>
    @endif

    @if (session()->has('success_message'))
    <div class="alert alert-success">Owner was deleted.</div>
    @endif

    @if (count($owners)== 0)
    <p>There are no owners</p>
    @endif

    <a class="btn btn-primary my-2" href="{{route('owner.create')}}">Create new Owner</a>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Tasks</th>
            <th>Action</th>
        </tr>

        @foreach ($owners as $owner)
        <tr>
            <td>{{$owner->id}}</td>
            <td>{{$owner->name}}</td>
            <td>{{$owner->surname}}</td>
            <td>{{$owner->email}}</td>
            <td>{{$owner->phone}}</td>
            <td>{{count($owner->ownerTasks)}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('owner.show', [$owner])}}">Show</a>
                <a class="btn btn-success" href="{{route('owner.edit', [$owner])}}">Edit</a>
                <form action="{{route('owner.destroy', [$owner])}}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>


@endsection