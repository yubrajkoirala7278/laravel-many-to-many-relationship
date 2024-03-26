@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4">Edit Post</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                    value="{{ old('title', $post->title) }}">
                @if ($errors->has('title'))
                    <span class="text-danger text-sm">{{ $errors->first('title') }}</span>
                @endif
            </div>
            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" placeholder="Description" id="description" name="description">{{ old('description', $post->description) }}</textarea>
                @if ($errors->has('description'))
                    <span class="text-danger text-sm">{{ $errors->first('description') }}</span>
                @endif
            </div>
            {{-- Status (static single select) --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option disabled value="">Choose Option</option>
                    <option @selected(old('status', $post->status) == 1) value="1">Publish</option>
                    <option @selected(old('status', $post->status) == 0) value="0">Draft</option>
                </select>
                @if ($errors->has('status'))
                    <span class="text-danger text-sm">{{ $errors->first('status') }}</span>
                @endif
            </div>
            {{-- Category (dynamic single select) --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category" id="category">
                    <option selected disabled value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option @selected(old('category', $post->caregory_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @if (count($categories) == 0)
                        <option value="" disabled>No Category</option>
                    @endif
                </select>


                @if ($errors->has('category'))
                    <span class="text-danger text-sm">{{ $errors->first('category') }}</span>
                @endif
            </div>
            {{-- Tags (dynamic multiple select) --}}
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select class="form-select" id="select-tags" data-placeholder="Choose Tags" multiple name="tags[]">
                    @foreach ($tags as $tag)
                        <option {{ $post->tags->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tags'))
                    <span class="text-danger text-sm">{{ $errors->first('tags') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    {{-- multiple select fields --}}
    <script>
        $(document).ready(function() {
            $('#select-tags').select2({
                theme: "bootstrap-5", // Use "bs5" for Bootstrap 5
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                tags: true
            });
        });
    </script>
@endsection
