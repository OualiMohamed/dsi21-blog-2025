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
                            <a onclick="confirmation(event, 'Are you sure to edit ?')" class="btn btn-outline-warning"
                                href="{{ Route('posts.edit', $post->id) }}">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}"
                                onclick="confirmation(event, 'Are you sure to delete ?')"
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

    <script>
        function confirmation(event, message) {
            event.preventDefault(); // Prevent the default action (navigation)
            var link = event.currentTarget; // Get the clicked link

            swal({
                title: message,
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = link.href; // Redirect to the link's URL
                }
            });
        }
    </script>
    </body>

    </html>
