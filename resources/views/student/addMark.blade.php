@extends('layouts.app')
@include('layouts.message')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Update Mark</h3>
                    </div>
                    <div class="col">
                        <input type="button" name="add" id="add" value="Add" class="btn btn-success">
                    </div>
                    <div class="col">
                        <a href="{{route('students.index')}}" class="btn btn-primary float-end">Student List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['students.subjects.storeMark', $student->id ],'method' => 'post')) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Student name:</strong>
                            <h5>{{$student->full_name}}</h5>
                        </div>
                        <div class="table table-sm">
                            <div class="addMore">
                                <div class="m-2" id="table_field">
                                    @foreach($marks as $subject_id => $mark)
                                        @if(!empty($subject_id))
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    {!! Form::select('subject_ids[]', $subjects, $subject_id, ['class' => 'form-select']) !!}
                                                </div>
                                                <div class="form-group col-4">
                                                    {!! Form::text('marks[]', $mark, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group col-4">
                                                    {!! Form::button('<i class="bi bi-trash3-fill"></i>',['class'=>'btn btn-danger remove','type'=>'submit']) !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if(!isset($student))
                            {!! Form::submit('Create', ['class' => 'btn btn-success mt-2','style'=>'margin-left:12px'])!!}
                        @else
                            {!! Form::submit('Update',['class'=> 'btn btn-success mt-2','style'=>'margin-left:12px']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="addMore d-none">
                {!! Form::select('subject_ids[]', $subjects, null, ['class' => 'form-select1']) !!}
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                var selected = [];
                $(document).ready(function () {
                    updateMarks()
                    var subject_count = {{$subject_count}};

                    $("#add").on('click', function () {
                        var subjects = $('select.form-select1').html();
                        var html = '<div class="row">'
                            + '<div class="form-group col-4">'
                            + '<select name="subject_ids[]" class="form-select">'
                            + '<option value="">--Subject--</option>'
                            + subjects
                            + '</select>'
                            + '</div>'
                            + '<div class="form-group col-4">'
                            + '{!! Form::text('marks[]', null, ['class' => 'form-control']) !!}'
                            + '</div>'
                            + '<div class="form-group col-4">'
                            + '{!! Form::button('<i class="bi bi-trash3-fill"></i>',['class'=>'btn btn-danger remove','type'=>'submit']) !!}'
                            + '</div>'
                            + '</div>'
                            + '</div>'

                        var el = $('select.form-select').length;
                        if (el < subject_count) {
                            $("#table_field").append(html);
                        } else {
                            $('#add').hide();
                        }
                        updateMarks()
                    })

                    $(document).on("change", "select.form-select", function () {
                        updateMarks()
                    })

                    $(document).on('click', '.remove', function () {
                        $(this).parent().parent().remove();
                        updateMarks()
                        $('#add').show();
                    })

                    function updateMarks() {
                        selected = []
                        $selects = $('select#subject_ids');
                        $('.form-select option').show();

                        $('select.form-select').each(function (index, select) {
                            if (select.value !== "") {
                                selected.push($(this).val());
                            }
                        })

                        $('select.form-select').each(function (index, select) {
                            $(this).find('option').each(function (optionIndex, option) {
                                for (var i in selected) {
                                    if (select.value != selected[i] && this.value == selected[i]) {
                                        $(this).hide()
                                    }
                                }
                            })

                        })

                    }
                })
            </script>
@endsection
