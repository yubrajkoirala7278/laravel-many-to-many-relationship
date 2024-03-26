@extends('admin.layouts.master')

@section('content')
    <div>
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
        <table class="table mt-4 pa-2">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($posts) > 0)
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->description, 15) }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                @if (count($tags) > 0)
                                    @foreach ($tags as $tag)
                                        {{ $post->tags->contains($tag->id) ? $tag->name.',' : '' }}
                                    @endforeach
                                @endif
        
                            </td>
                            <td>
                                <div class="d-flex align-items-center" style="gap: 10px">
                                    <a href="{{route('posts.show',$post->id)}}" class="text-primary"><i class="fa-regular fa-eye"></i></a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-warning"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent text-danger p-0 show-alert-delete-box"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>No post found</p>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('script')
@endsection
