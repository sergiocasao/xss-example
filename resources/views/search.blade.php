@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background-color: white;">

            <h2>Search: {!! $query !!}</h2>

            <ul class="media-list">
                @forelse ($results as $user)

                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="http://lorempixel.com/64/64?id={{ rand(0, 1000) }}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $user->name }} <small>member since {{ $user->created_at->diffForHumans() }}</small></h4>
                            @if (Auth::user()->iFollow($user))
                                Friends since {{ Auth::user()->friendships->where('follower_id', $user->id)->first()->created_at->diffForHumans() }}
                            @else
                                <a href="#">Follow</a>
                            @endif
                        </div>
                    </li>

                @empty

                    No results matching your query.

                @endforelse
            </ul>

        </div>
    </div>
</div>
@endsection
