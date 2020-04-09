<table class = "table table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Related Posts</td>
            <td>Role</td>
            <td>Action</td>
        </tr>
    <thead>
    <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->posts->count()}}</td>
                <td>-???</td>
                <td>
                        <a href  = '{{ route("admin.user.edit", $user->id)}}' class = "btn btn-sx btn-primary">
                        <i class = "fa fa-edit"></i>
                        </a>
                        @if ($user->id == config('cms.DEFAULT_USER_ID') || Auth::id() == $user->id)
                            <button type  = "submit" onclick = "return false;" class = "btn btn-danger btn-sx" disabled = "disabled">
                            <i class = "fa fa-times"></i>
                            </button>
                        @else
                            <a href="{{route('admin.user.confirm', $user->id)}}" class = "btn btn-danger btn-sx">
                            <i class = "fa fa-times"></i>
                            </button>
                        @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
