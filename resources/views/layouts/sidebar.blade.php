
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

                <div class="widget">
                    <div class="widget-heading">
                        <h4>Popular Posts</h4>
                    </div>
                    <div class="widget-body">
                        <ul class="popular-posts">
                            @foreach($populars as $popular)
                                <li>
                                    @if($popular->image_url)
                                        <div class="post-image">
                                            <a href="#">
                                                <img src="{{$popular->image_url}}" />
                                            </a>
                                        </div>
                                    @endif
                                    <div class="post-body">
                                        <h6><a href="{{route('post.show', $popular->slug)}}">{{$popular->title}}</a></h6>
                                        <div class="post-meta">
                                            <span>{{$popular->date}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
