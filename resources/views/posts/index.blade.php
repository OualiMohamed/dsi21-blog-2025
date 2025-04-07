    @extends('layouts.app')


    @section('content')
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ url('posts/create') }}" class="btn btn-primary">New Post</a>
        <h2 class="py-4">Blog DSI21</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <a class="btn btn-outline-info" href="{{ Route('posts.show', $post->id) }}">Show</a>
                            <a class="btn btn-outline-warning" href="{{ Route('posts.edit', $post->id) }}">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this post?')"
                                style="display: inline-block;" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    </body>

    </html>
