@extends('layouts.app')
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            @if(!empty($student))
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{asset('images/'.$student->image)}}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{$student->full_name}}</h5>
                            <div class="d-flex justify-content-center mb-2">
                                {!! Form::open(['method'=>'GET', 'route' => ['students.edit', $student->id]]) !!}
                                {!! Form::submit('Edit profile',['class'=>'btn btn-primary','style'=>'margin-right:10px']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method'=>'GET', 'route' => ['students.subjects.createMark', $student->id]]) !!}
                                {!! Form::submit('Edit mark',['class'=>'btn btn-primary ']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">@lang('Full Name')</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$student->full_name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">@lang('Email')</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$student->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">@lang('Phone')</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$student->phone}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">@lang('Address')</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$student->address}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">@lang('Subject')</p>
                                </div>
                                @foreach($student->subjects as $subject)
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$subject->name}}: <span>{{$subject->pivot->mark}}</span></p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

@endsection
