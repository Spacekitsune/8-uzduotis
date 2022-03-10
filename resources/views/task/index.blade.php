@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Tasks list</h1>

    @if (session()->has('success_message'))
    <div class="alert alert-success">Task was deleted.</div>
    @endif

    @if (count($tasks)== 0)
    <p>There are no tasks</p>
    @endif

    <a class="btn btn-primary my-2" href="{{route('task.create')}}">Create new Task</a>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Owner</th>
            <th>Logo</th>
            <th>Action</th>
        </tr>

        @foreach ($tasks as $task)
        <tr>
            <td>{{$task->id}}</td>
            <td>{{$task->title}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->start_date}}</td>
            <td>{{$task->end_date}}</td>
            <td>{{$task->taskOwner->name}} {{$task->taskOwner->surname}}</td>
            <td><img src="/images/{{$task->logo}}" alt="{{$task->logo}}" height="100px"></td> 
            <td>
                <a class="btn btn-success" href="{{route('task.edit', [$task])}}">Edit</a>
                <form class="d-inline" action="{{route('task.destroy', [$task])}}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>


@endsection