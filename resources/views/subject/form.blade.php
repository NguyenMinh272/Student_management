@extends('layouts/app')
@section('content')
    @include('layouts.message')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>New Subject</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('subjects.index')}}" class="btn btn-primary float-end">Subject List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(!isset($subject))
                    {!! Form::open(array('route' => 'subjects.store','method' => 'post')) !!}
                @else
                    {!! Form::open(array('route' => ['subjects.update',$subject->id],'method' => 'put')) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Subject name', []) !!}
                            {!! Form::text('name', isset($subject) ? $subject->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>
                    </div>
                </div>
                @if(!isset($subject))
                    {!! Form::submit('Create', array('class' => 'btn btn-success mt-2')) !!}
                @else
                    {!! Form::submit('Update',['class'=> 'btn btn-success mt-2']) !!}
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
