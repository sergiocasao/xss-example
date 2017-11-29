@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding: 20px 0;">
        <div class="col-md-8 col-md-offset-2" style="background-color: white; padding: 20px;">

            <h2>Resultados de: {!! $query !!}</h2>

            <br>

            <ul class="media-list">
                @forelse ($results as $user)

                    <hr>
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="http://lorempixel.com/48/48?id={{ rand(0, 1000) }}" alt="..." style="border-radius: 50%;">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $user->name }} <small>miembro desde {{ $user->created_at->diffForHumans() }}</small></h4>
                            @if (Auth::user()->iFollow($user))
                                <small>Amigos desde {{ Auth::user()->friendships->where('follower_id', $user->id)->first()->created_at->diffForHumans() }} </small><br>
                            @else
                                @if (Auth::user() != $user)
                                    <form class="" action="{{ route('follow') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="follower" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-link" style="padding: 0;">Seguir</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </li>

                @empty

                    No hay resultados que coincidan con tu búsqueda.

                @endforelse

                <hr>
            </ul>

        </div>
    </div>
</div>
@endsection
