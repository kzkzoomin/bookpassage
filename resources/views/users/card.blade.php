<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
    </div>
    @if (Auth::id() == $user->id)
        {!! link_to_route('posts.create', '新規投稿', [], ['class' => 'btn btn-primary']) !!}
    @endif
</div>
@include('user_follow.follow_button', ['user' => $user])