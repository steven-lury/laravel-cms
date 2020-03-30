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
        All Posts
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Posts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header clearfix">
                    <div class="pull-left">
                        <a href="{{route('admin.post.create')}}" class="btn btn-success">Add Post</a>
                    </div>
                    <div class="pull-right">
                        <a href="?status=all">All</a> |
                        <a href="?status=trash">Trash</a>
                    </div>
                </div>

              <!-- /.box-header -->
              <div class="box-body ">
                @if( !$posts->count())
                    <div class="box-header">
                        <div class="alert alert-danger">
                            <strong>No Post Found</strong>
                        </div>
                    </div>
                @else

                @include('backend.layouts.message')
                    @if ($trash)
                        @include('backend.posts.trash')
                    @else
                        @include('backend.posts.all-post')
                    @endif

                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                    <div class="pull-left">
                        {{$posts->links()}}
                    </div>
                    <div class="pull-right">
                        <small>{{$postCount}} {{ str_plural('Post', $postCount) }}</small>
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

<script>
    $('ul.pagination').addClass('no-margin pagination-sm');
    $(document).on('ready', function(){
        $(".alert").show();
        setTimeout(function() { $(".alert").fadeOut(); }, 5000);
    });
</script>

@endpush
