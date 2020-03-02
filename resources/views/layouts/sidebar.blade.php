
                <div class="widget">
                    <div class="widget-heading">
                        <h4>Categories</h4>
                    </div>
                    <div class="widget-body">
                        <ul class="categories">
                            @foreach($categories as $cat)
                                    <li>
                                        <a href="{{route('category', $cat->slug)}}"><i class="fa fa-angle-right"></i> {{$cat->title}}</a>
                                        <span class="badge pull-right">{{$cat->posts->count()}}</span>
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                </div>
