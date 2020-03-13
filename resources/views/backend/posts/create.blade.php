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
        <li>
            <a href="{{route('post.index')}}">Posts</a>
        </li>
        <li class="active">Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route('post.create')}}" class="btn btn-success">Add Post</a>
                </div>
              <!-- /.box-header -->
              <div class="box-body">
                  @if($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="alert alert-danger">
                            {{$err}}
                        </div>
                    @endforeach
                @endif
                {!! Form::open([
                    'method' => 'POST',
                    'route'  => 'post.store',
                    'files'   => 'true'
                ]) !!}

                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                        {!! Form::label('title') !!}
                        {!! Form::text('title', null, ['calss' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                        {!! Form::label('slug') !!}
                        {!! Form::text('slug', null, ['calss' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                        {!! Form::label('Feature Image') !!}
                        {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                        {!! Form::label('published_at') !!}
                        {!! Form::text('published_at', null, ['calss' => 'form-control', 'placeholder' => 'Y-m-d H:i:s']) !!}
                    </div>
                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        {!! Form::label('body') !!}
                        {!! Form::textarea('body', null, ['calss' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                        {!! Form::label('excerpt') !!}
                        {!! Form::textarea('excerpt', null, ['calss' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                        {!! Form::label('category') !!}
                        {!! Form::select('category_id', \App\category::pluck('title', 'id'), null, ['calss' => 'form-control', 'placeholder'=>'Choose Category']) !!}
                    </div>
                <hr>
                {!! Form::submit('Create Post', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
              </div>
              <!-- /.box-body -->
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
</script>

@endpush
