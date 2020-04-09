@extends('backend.layouts.app')

@section('title')

    {{'Dashboard | Users'}}

@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Users
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a href="{{route('admin.user.create')}}" class="btn btn-success">Add A New User</a>
                    </div>
                </div>

              <!-- /.box-header -->
              <div class="box-body ">
                @if( !$users->count())
                    <div class="box-header">
                        <div class="alert alert-danger">
                            <strong>No User Found</strong>
                        </div>
                    </div>
                @else

                @include('backend.layouts.message')
                    @include('backend.users.all-users')
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                    <div class="pull-left">
                        {{$users->appends(Request::query())->links()}}
                    </div>
                    <div class="pull-right">
                        <small>{{$UsersCount}} {{ str_plural('Category', $UsersCount) }}</small>
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
