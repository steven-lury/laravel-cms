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

                    {!! Form::open(
                        ['method'=>'DELETE',
                        'route' => ['admin.post.destroy', $post->id]
                        ]
                        ) !!}
                        <a href='{{ route("admin.post.edit", $post->id)}}' class="btn btn-sx btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sx">
                            <i class="fa fa-trash"></i>
                        </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
