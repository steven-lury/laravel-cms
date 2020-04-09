@extends('backend.layouts.app')

@section('title')

    {{'Dashboard'}}

@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Categories
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a href="{{route('admin.category.create')}}" class="btn btn-success">Add A Category</a>
                    </div>
                </div>

              <!-- /.box-header -->
              <div class="box-body ">
                @if( !$categories->count())
                    <div class="box-header">
                        <div class="alert alert-danger">
                            <strong>No Category Found</strong>
                        </div>
                    </div>
                @else

                @include('backend.layouts.message')
                    @include('backend.categories.all-categories')
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                    <div class="pull-left">
                        {{$categories->appends(Request::query())->links()}}
                    </div>
                    <div class="pull-right">
                        <small>{{$CategoryCount}} {{ str_plural('Category', $CategoryCount) }}</small>
                    </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')

@include('backend.layouts.common-script')

@endpush
