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
                    'method' => 'DELETE',
                    'route' => ['admin.user.destroy', $user->id]
                    ]) !!}
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="panel panel-primary">
                            <div class="panel panel-danger">
                                <div class="panel panel-heading">You Are About To Remove <strong>{{$user->name}}</strong> :: With ID # <b>{{$user->id}}</b></div>
                            </div>
                            <div class="panel-heading">
                                What should to be doen wiht the content of the user
                            </div>
                            <div class="panel panel-body">
                                <div class="radio">
                                    <label>{!! Form::radio('action', 'all', 'checked') !!}Delete All</label>
                                </div>
                                <div class="radio">
                                    <label>{!! Form::radio('action', 'user') !!}Assign User</label>
                                    {!! Form::select('users', $users) !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.user.index')}}" class="btn btn-default">Cancel</a>
                            </div>
                            <div class="pull-right">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
