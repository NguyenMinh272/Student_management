@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>@lang('Faculty Management')</h3>
                </div>
                <div class="col-md-6">'
                    <a href="{{route('faculties.create')}}" class="btn btn-success float-end">@lang('New Faculty')</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('Faculty')</th>
                    <th colspan="2">@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($faculties))
                    @foreach ($faculties as $key => $faculty)
                        <tr>
                            <th scope="row">{{$key+=1}}</th>
                            <td>{{$faculty->name}}</td>
                            <td>
                                {!! Form::open(['method'=>'GET', 'route' => ['faculties.edit', $faculty->id]]) !!}
                                {!! Form::button('<i class="bi bi-pencil-square"></i>',['class'=>'btn btn-warning', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method'=>'DELETE', 'route' => ['faculties.destroy', $faculty->id], 'onsubmit'=>'return confirm("Are you sure?")']) !!}
                                {!! Form::button('<i class="bi bi-trash3-fill"></i>',['class'=>'btn btn-danger','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
            {{$faculties->links("pagination::bootstrap-4")}}
        </div>
    </div>

@endsection
