@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                @include('users.card', ['user' => Auth::user()])
            </aside>
            <div class="col-sm-8">
                @if (count($posts) > 0)
                    @include('posts.posts', ['posts' => $posts])
                @endif
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h2>あなたのお気に入りの本の一節を紹介しましょう</h2>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection