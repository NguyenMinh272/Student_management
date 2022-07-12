@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Register Subject</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('students.index')}}" class="btn btn-primary float-end">Student List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(!isset($student))
                    {!! Form::open(array('route' => 'students.store','method' => 'post')) !!}
                @else
                    {!! Form::open(array('route' => ['students.subjects.storeSubject',$student->id],'method' => 'post')) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Student name', []) !!}
                            {!! Form::hidden('student_id', $student->id ) !!}
                            {!! Form::text('name', isset($student) ? $student->full_name: '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('subject', 'Subject', []) !!}<br>
                            @foreach($subjects as $key => $subject)
                                {!! Form::checkbox('subject_id[]',$subject->id, isset( $student->subject_id) ? 'checked' : '') !!}
                                {!! Form::label('subject_name', $subject->name, []) !!}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if(!isset($student))
                    {!! Form::submit('Update', ['class' => 'btn btn-success mt-2'])!!}
                @else
                    {!! Form::submit('Create',['class'=> 'btn btn-success mt-2']) !!}
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
