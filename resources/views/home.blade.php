@extends('layouts.app')

@section('content')

<div class="container-fluid" style="">
    <div class="row" style="padding: 20px 0;">
        <div class="col-md-3">
            <div style="padding: 20px; background-color: white; border-radius: 5px;">
                <div style="display: flex;">
                    <div style="margin-right: 10px;">
                        {{-- <img class="media-object" src="https://lorempixel.com/48/48?me" alt="..." style="border-radius: 50%; margin-bottom: 10px;"> --}}
                    </div>
                    <div>
                        <span><strong>{{ Auth::user()->name }}</strong></span> <br>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <div style="margin-top: 10px;">
                    <span><strong>{{ Auth::user()->statuses->count() }}</strong> publicaciones</span>
                    <br>
                    <span><strong>{{ Auth::user()->followers->count() }}</strong> seguidores</span>
                    <br>
                    <span><strong>{{ Auth::user()->friendships->count() }}</strong> seguidos</span>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="clearfix" style="background-color: white; padding: 20px;">
                <form class="" action="/status" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="status">Publica algo</label>
                        <textarea name="status" rows="4" cols="80" class="form-control" placeholder="¿Qué estás pensando?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default pull-right">Publicar</button>
                </form>
            </div>

            <h3>Historias</h3>

            <ul class="media-list" style="background-color: white;">
                @foreach ($statuses as $status)

                    <li class="media" style="padding: 20px;">
                        <div class="media-left">
                            <a href="#">
                                {{-- <img class="media-object" src="https://lorempixel.com/48/48?me" alt="..." style="border-radius: 50%;"> --}}
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <strong>{{ $status->user->name }} </strong>
                                <small>{{ $status->created_at->diffForHumans() }}</small>
                            </h5>
                            <p>
                                {!! $status->description !!}
                            </p>

                            @if ($status->isLikedBy(Auth::user()))
                                {{ $status->likes->count() }} <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i> <br>
                            @else
                                <form class="loveform" action="{{ route('love', $status->id) }}" method="post">
                                    {{ $status->likes->count() }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default" name="button" style="border: 0; background-color: white;"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                </form>
                            @endif

                            @if (!$status->comments->isEmpty())
                                 <h5>Comentarios:</h5>
                            @endif

                            @foreach ($status->comments as $comment)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            {{-- <img class="media-object" src="https://lorempixel.com/48/48?id={{ $comment->user->name }}" alt="..." style="border-radius: 50%;"> --}}
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>{{ $comment->user->name }}</strong> <small>{{ $comment->created_at->diffForHumans() }} </small></h5>
                                        @if (Auth::user()->iFollow($comment->user))
                                            <small>Amigos desde {{ Auth::user()->friendships->where('follower_id', $comment->user->id)->first()->created_at->diffForHumans() }} </small><br>
                                        @else
                                            @if (Auth::user()->id != $comment->user->id)
                                                <form class="followform" action="{{ route('follow') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="follower" value="{{ $comment->user->id }}">
                                                    <button type="submit" class="btn btn-link" style="padding: 0;">Seguir</button>
                                                </form>
                                            @endif
                                        @endif
                                        <p>
                                            {!! $comment->comment !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        {{-- <img class="media-object" src="https://lorempixel.com/48/48?me" alt="..." style="border-radius: 50%;"> --}}
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>{{ Auth::user()->name }}</strong></h5>
                                    <form class="" action="{{ route('status.comment.store', $status->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <textarea class="form-control" name="comment" value=""></textarea> <br>
                                        <button type="submit" class="btn btn-default pull-right" style="background-color: #E91E63; color: white; border: 0;">Comentar</button>
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
