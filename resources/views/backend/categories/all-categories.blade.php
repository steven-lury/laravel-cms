<table class = "table table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Related Posts</td>
            <td>Action</td>
        </tr>
    <thead>
    <tbody>
        @foreach($categories as $key => $category)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$category->title}}</td>
                <td>{{$category->posts->count()}}</td>
                <td>

                    {!! Form::open(
                        ['method'=>'DELETE',
                        'route' => ['admin.category.destroy', $category->id]
                        ]
                        ) !!}
                        <a href  = '{{ route("admin.category.edit", $category->id)}}' class = "btn btn-sx btn-primary">
                        <i class = "fa fa-edit"></i>
                        </a>
                        @if ($category->id == config('cms.DEFAULT_CAT_ID'))
                            <button type  = "submit" onclick = "return false;" class = "btn btn-danger btn-sx" disabled = "disabled">
                            <i      class = "fa fa-times"></i>
                            </button>
                        @else
                            <button type  = "submit" onclick = "return confirm('Are You Sure?');" class = "btn btn-danger btn-sx">
                            <i      class = "fa fa-times"></i>
                            </button>
                        @endif

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
