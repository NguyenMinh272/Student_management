@extends('layouts/app')
@section('content')
    @include('layouts.message')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>New faculty</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('faculties.index')}}" class="btn btn-primary float-end">Faculty List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(!isset($faculty))
                    {!! Form::open(array('route' => 'faculties.store','method' => 'post')) !!}
                @else
                    {!! Form::open(array('route' => ['faculties.update',$faculty->id],'method' => 'put')) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Faculty name', []) !!}
                            {!! Form::text('name', isset($faculty) ? $faculty->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>
                    </div>
                </div>
                @if(!isset($faculty))
                    {!! Form::submit('Create', array('class' => 'btn btn-success mt-2')) !!}
                @else
                    {!! Form::submit('Update',['class'=> 'btn btn-success mt-2']) !!}
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
