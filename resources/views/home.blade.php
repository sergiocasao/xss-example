@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: -22px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background-color: white;">

            {{-- <h2>Me siguen:</h2>
            @foreach (Auth::user()->followers as $follower)
                {{ $follower->user->name }} <br>
                Seguido desde: {{ $follower->created_at->diffForHumans() }} <br><br>
            @endforeach

            <h2>Yo sigo:</h2>
            @foreach (Auth::user()->friendships as $friendship)
                {{ $friendship->follower->name }} <br>
                Seguido desde: {{ $friendship->created_at->diffForHumans() }} <br><br>
            @endforeach --}}

            <br>

            <div class="clearfix">

                <form class="" action="/status" method="post">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="status">Publica algo</label>
                        <textarea name="status" rows="8" cols="80" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default pull-right">Publicar</button>

                </form>

            </div>

            <h1>Historias</h1>

            <ul class="media-list">
                @foreach ($statuses as $status)

                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="http://lorempixel.com/64/64?id={{ rand(0, 1000) }}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $status->user->name }} <small>{{ $status->created_at->diffForHumans() }}</small></h4>
                            {!! $status->description !!} <br>
                            @if ($status->isLikedBy(Auth::user()))
                                {{ $status->likes->count() }} <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i> <br>
                            @else
                                <form class="" action="{{ route('love', $status->id) }}" method="post">
                                    {{ $status->likes->count() }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default" name="button"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                </form>
                            @endif

                            @if (!$status->comments->isEmpty())
                                 <br><h5>Comentarios:</h5>
                            @endif

                            @foreach ($status->comments as $comment)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object" src="http://lorempixel.com/64/64?id={{ rand(0, 1000) }}" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }} </small></h4>
                                        @if (Auth::user()->iFollow($comment->user))
                                            <small>Friends since {{ Auth::user()->friendships->where('follower_id', $comment->user->id)->first()->created_at->diffForHumans() }} </small><br>
                                        @else
                                            @if (Auth::user()->id != $comment->user->id)
                                                <form class="" action="{{ route('follow') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="follower" value="{{ $comment->user->id }}">
                                                    <button type="submit" class="btn btn-link">Follow</button>
                                                </form>
                                            @endif
                                        @endif
                                        {!! $comment->comment !!}
                                    </div>
                                </div>
                            @endforeach

                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="http://lorempixel.com/64/64?id={{ Auth::user()->id }}" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ Auth::user()->name }}</h4>
                                    <form class="" action="{{ route('status.comment.store', $status->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <textarea class="form-control" name="comment" value=""></textarea> <br>
                                        <button type="submit" class="btn btn-default pull-right">Comentar</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </li>

                    <hr>

                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection
