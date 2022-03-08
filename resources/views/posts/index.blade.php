@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.index') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body">
                                                                                                                </textarea>
                                @error('body')
                                    <span class="text text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success m-2" type="submit">
                                    Add
                                </button>
                            </div>
                        </form>
                        <hr>
                        @if (count($posts) === 0)
                            <h1>
                                No Posts
                            </h1>
                        @else
                            <div class="m-4">
                                @foreach ($posts as $post)
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
                                @endforeach
                            </div>
                        @endif
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
