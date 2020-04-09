@extends('backend.layouts.app')

@section('title')

    {{'Dashboard | Edit Category'}}

@endsection

@push('css')

<link rel="stylesheet" href="{{asset('backend/plugins/simple-mde/simplemde.min.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="{{asset('backend/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')}}">
@endpush


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Category
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{route('admin.category.index')}}">Categories</a>
        </li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-8">
            <div class="box">
                <div class="box-header">
                    Edit category <b>{{$category->title}}</b>
                </div>
                {!! Form::open([
                    'method' => 'PUT',
                    'route'  => ['admin.category.update', $category->id],
                    'files'  => 'true',
                    'id'     => 'category-form'
                ]) !!}
            <!-- /.box-header -->

            <div class="box-body">
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                    {!! Form::label('title') !!}
                    {!! Form::text('title', html_entity_decode($category->title), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                    {!! Form::label('slug') !!}
                    {!! Form::text('slug', html_entity_decode($category->slug), ['class' => 'form-control']) !!}
                </div>
            <hr>



            </div>

                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    </div>
                    <div class="col-xs-4">
                        <div class="box">
                            <div class="box-header">
                                Update
                            </div>

                            <div class="box-footer clear-fix">
                                <div class="pull-left">
                                    <a href="{{route('admin.category.index')}}"  class="btn btn-default">Cancel</a>
                                </div>
                                <div class="pull-right">
                                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
        <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

<script src="{{asset('backend/plugins/simple-mde/simplemde.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('backend/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
@include('backend.layouts.common-script')

@endpush
