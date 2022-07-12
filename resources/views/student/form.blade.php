@extends('layouts/app')
@section('content')
    @include('layouts.message')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>New Student</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('students.index')}}" class="btn btn-primary float-end">Student List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(!isset($student))
                    {!! Form::open(array('route' => 'students.store','method' => 'post','enctype'=>'multipart/form-data')) !!}
                @else
                    {!! Form::open(array('route' => ['students.update',$student->id],'method' => 'put','enctype'=>'multipart/form-data')) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Student name', []) !!}
                            {!! Form::text('full_name', isset($student) ? $student->full_name : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('faculty', 'Faculty', []) !!}
                            {!! Form::select('faculty_id', $faculties ,isset($student) ? $student->faculty: '', ['class' => 'form-control']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::text('email', isset($student) ? $student->email : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address', []) !!}
                            {!! Form::text('address', isset($student) ? $student->address : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone number', []) !!}
                            {!! Form::text('phone', isset($student) ? $student->phone : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('birthday', 'Birthday', []) !!}
                            {!! Form::date('birthday', isset($student) ? $student->birthday : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('gender', 'Gender', []) !!}
                            {!! Form::radio('gender', '0', true) !!}
                            <span>Nam</span>
                            {!! Form::radio('gender', '1') !!}
                            <span>Nữ</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Avatar', []) !!}
                            {!! Form::file('image',  ['class' => 'form-control-file']) !!}
                        </div>

                        @if(!isset($student))
                            {!! Form::submit('Create', ['class' => 'btn btn-success mt-2'])!!}
                        @else
                            {!! Form::submit('Update',['class'=> 'btn btn-success mt-2']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
