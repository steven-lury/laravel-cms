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
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body ">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Title</td>
                                <td>Author Name</td>
                                <td>Category</td>
                                <td>Published Date</td>
                                <td>Action</td>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->category->title}}</td>
                                    <td>
                                        <abbr title="{{$post->timePublished(true)}}"> {{$post->timePublished()}}</abbr>|
                                            {!! $post->publishedLabel() !!}
                                    </td>
                                    <td>
                                        <a href="{{route('post.edit', $post->id)}}" class="btn btn-sx btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('post.destroy', $post->id)}}" class="btn btn-danger btn-sx">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                    <div class="pull-left">
                        <ul class="pagination no-margin">
                            {{$posts->links()}}
                        </ul>
                    </div>
                    <div class="pull-right">
                        <small>{{$posts->count()}} {{str_plural("post", $posts->count())}}</small>
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
