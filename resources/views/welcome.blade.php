@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h2>あなたのお気に入りの本の一節を紹介しましょう</h2>
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection