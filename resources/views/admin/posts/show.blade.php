@extends('admin.layouts.master')
@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-6">View Post</h2>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th scope="col">Title</th>
                    <td>{{ $post->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Description</th>
                    <td>{{ $post->description, 15 }}</td>
                </tr>
                <tr>
                    <th scope="col">Category</th>
                    <td>{{ $post->category->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Username</th>
                    <td>{{ $post->user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Status</th>
                    <td>{{ $post->status == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
                <tr>
                    <th scope="col">Tags</th>
                    <td>
                        @if (count($tags) > 0)
                            @foreach ($tags as $tag)
                                {{ $post->tags->contains($tag->id) ? $tag->name.' | ' : '' }}
                            @endforeach
                        @endif

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
