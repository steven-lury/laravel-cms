    @extends('backend.layouts.app')

    @section('title')

        {{'Dashboard | Create A New Post'}}

    @endsection

    @push('css')

    <link rel="stylesheet" href="{{asset('backend/plugins/simple-mde/simplemde.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    @endpush


    @section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
        Create Post
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('dashboard.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.post.index')}}">Posts</a>
            </li>
            <li class="active">Create</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
                        <a href="{{route('admin.post.create')}}" class="btn btn-success">Add Post</a>
                    </div>
                    @if ($errors->any())

                            @foreach ($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}
                            </div>
                            @endforeach

                        @endif
                    {!! Form::open([
                        'method' => 'POST',
                        'route'  => 'admin.post.store',
                        'files'  => 'true',
                        'id'     => 'post-form'
                    ]) !!}
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                        {!! Form::label('title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                        {!! Form::label('slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>


                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        {!! Form::label('body') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                        {!! Form::label('excerpt') !!}
                        {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
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
                            Published
                        </div>
                        <div class="box-body">
                            <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                                <div class="input-group date" id='published_at'>
                                    {!! Form::text('published_at', null, ['id' => 'post-time','class' => 'form-control', 'placeholder' => 'Y-m-d H:i:s']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer clear-fix">
                            <div class="pull-left">
                                <a href="#" id="draft-btn" class="btn btn-default">Save & Draft</a>
                            </div>
                            <div class="pull-right">
                                {!! Form::submit('Publish', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        </div>
                        <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Category
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                                {!! Form::select('category_id', \App\category::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder'=>'Choose Category']) !!}
                            </div>
                        </div>
                        </div>
                        <div class="box ">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Feature Image
                            </h3>
                        </div>
                        <div class="box-body center">
                            <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>{!! Form::file('image', null, ['class' => 'form-control']) !!}</span></span>
                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                </div>
                        </div>
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

    @endsection

    @push('js')

    <script src="{{asset('backend/plugins/simple-mde/simplemde.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    @include('backend.posts.script')

    @endpush
