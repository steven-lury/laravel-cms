@if( session('successMsg'))
    <div class="box-header">
        <div class="alert alert-success">
            {{session('successMsg')}}
        </div>
    </div>
@elseif(session('errorMsg'))
    <div class="box-header">
        <div class="alert alert-danger">
            {{session('errorMsg')}}
        </div>
    </div>
@elseif(session('trashMsg'))
    <?php list($msg, $postId) = session('trashMsg'); ?>
    <div class="alert alert-danger">
        {!! Form::open([
            'method' => 'PUT',
            'route' => ['admin.post.restore', $postId]
        ]) !!}
        {{$msg}}
        <button class="btn btn-xs btn-warning" type="submit"><i class="fa fa-undo">Undo</i></button>
        {!! Form::close() !!}
    </div>
@endif
