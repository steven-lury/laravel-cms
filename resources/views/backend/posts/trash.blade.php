<table class="table table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Author Name</td>
            <td>Category</td>
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

                    {!! Form::open(
                        ['method'=>'DELETE',
                        'route' => ['admin.post.force-destroy', $post->id],
                        'style' => 'display:inline-block'
                        ]
                        ) !!}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete For Ever');">
                            <i class="fa fa-times"></i>
                        </button>
                    {!! Form::close() !!}
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' => ['admin.post.restore', $post->id],
                        'style' => 'display:inline-block'
                    ]) !!}
                    <button type="submit" class="btn btn-warning btn-xs" ><i class="fa fa-refresh"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
