@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Subject Management</h3>
                </div>
                <div class="col-md-6">
                    <a href="{{route('subjects.create')}}" class="btn btn-success float-end">New Subject</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($subjects))
                    @foreach ($subjects as $key => $subject)
                        <tr>
                            <th scope="row">{{$key+=1}}</th>
                            <td>{{$subject->name}}</td>
                            <td>
                                {!! Form::open(['method'=>'GET', 'route' => ['subjects.edit', $subject->id]]) !!}
                                {!! Form::button('<i class="bi bi-pencil-square"></i>',['class'=>'btn btn-warning', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method'=>'DELETE', 'route' => ['subjects.destroy', $subject->id], 'onsubmit'=>'return confirm("Are you sure?")']) !!}
                                {!! Form::button('<i class="bi bi-trash3-fill"></i>',['class'=>'btn btn-danger','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$subjects->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection
