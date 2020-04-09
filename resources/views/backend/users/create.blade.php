@extends('backend.layouts.app')

@section('title')

{{'Dashboard | Create A New User'}}

@endsection

@push('css')

<link rel="stylesheet" href="{{asset('backend/plugins/simple-mde/simplemde.min.css')}}">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
@endpush


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create A User
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.user.index')}}">Users</a>
            </li>
            <li class="active">Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box">

                    @if ($errors->any())

                    @foreach ($errors->all() as $err)
                    <div class="alert alert-danger">
                        {{$err}}
                    </div>
                    @endforeach

                    @endif
                    {!! Form::open([
                    'method' => 'POST',
                    'route' => 'admin.user.store'
                    ]) !!}
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email') !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                            {!! Form::label('password') !!}
                            {!! Form::password('password', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                            {!! Form::label('password_confirmation') !!}
                            {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
                        </div>
                        <hr>
                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.user.index')}}" class="btn btn-default">Cancel</a>
                            </div>
                            <div class="pull-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                {!! Form::close() !!}
            </div>


        </div>
</div>

<!-- /.content-wrapper -->

@endsection

@push('js')

<script src="{{asset('backend/plugins/simple-mde/simplemde.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
@include('backend.layouts.common-script')

@endpush
