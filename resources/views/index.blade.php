@extends('layouts.app')

@section('title')
    {{'Index'}}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <article class="post-item">
                        @if($post->image)
                            <div class="post-item-image">
                                <a href="{{route('post.show', $post->slug)}}">
                                    <img src="{{$post->image_url}}" alt="">
                                </a>
                            </div>
                        @endif
                        <div class="post-item-body">
                            <div class="padding-10">
                                <h2><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h2>
                                <p>{!! Markdown::convertToHtml(e($post->excerpt)) !!}</p>
                            </div>

                            <div class="post-meta padding-10 clearfix">
                                <div class="pull-left">
                                    <ul class="post-meta-group">
                                        <li><i class="fa fa-user"></i><a href="{{route('user.post', $post->user->slug)}}"> {{$post->user->name}}</a></li>
                                        <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                        <li><i class="fa fa-tags"></i><a href="{{route('category', $post->category->slug)}}"> {{$post->category->title}}</a></li>
                                        <li><i class="fa fa-comments"></i><a href="#">{{$post->comments->count()}} Comments</a></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('post.show', $post->slug)}}">Continue Reading &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

                <nav>
                  <!-- <ul class="pager">
                    <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Newer</a></li>
                    <li class="next"><a href="#">Older <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>-->
                  {{$posts->links()}}
                </nav>
            </div>
            <div class="col-md-4">
                <aside class="right-sidebar">
                    <div class="search-widget">
                        <div class="input-group">
                          <input type="text" class="form-control input-lg" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-lg btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                          </span>
                        </div><!-- /input-group -->
                    </div>

                    @include('layouts.sidebar')



                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="tags">
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Codeigniter</a></li>
                                <li><a href="#">Yii</a></li>
                                <li><a href="#">Laravel</a></li>
                                <li><a href="#">Ruby on Rails</a></li>
                                <li><a href="#">jQuery</a></li>
                                <li><a href="#">Vue Js</a></li>
                                <li><a href="#">React Js</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
