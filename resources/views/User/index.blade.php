@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            {{ $user->username }}
                        </h3>
                    </div>

                    <div class="card-body">
                        @foreach ($user->posts as $post)
                            <div class="m-4">

                                <div class="justify-content align-items-center d-flex">
                                    <h3>
                                        <a href="{{ route('user.post.index', $post->user->username) }}">
                                            {{ $post->user->username }}</a>
                                    </h3>
                                    <span class="m-3">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p>
                                    {{ $post->body }} {{ $post->likes()->count() }}
                                </p>
                                <div class="justify-content-start align-items-center d-flex">

                                    @if ($post->user_id === auth()->user()->id)
                                        <form method="post" action="{{ route('post.destroy', $post) }}">
                                            @csrf
                                            @method("DELETE")
                                            <button type='submit' class="btn btn-sm m-1 btn-danger">Delete</button>
                                        </form>
                                    @endif



                                    @if (!$post->likeBy(auth()->user()))
                                        <form class=" m-1" action="{{ route('post.like', $post->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type='submit' class="btn btn-sm btn-outline-success">Like</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('post.dislike', $post) }}">
                                            @csrf
                                            @method("DELETE")
                                            <button type='submit' class="btn btn-sm btn-outline-danger">UnLike</button>
                                        </form>
                                    @endif


                                </div>
                                <hr />
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
