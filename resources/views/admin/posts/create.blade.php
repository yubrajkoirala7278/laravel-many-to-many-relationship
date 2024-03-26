@extends('admin.layouts.master')

@section('content')
    <div class="bg-white p-4">
        <h2 class="fs-5 mb-4">Create Post</h2>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                    value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <span class="text-danger text-sm">{{ $errors->first('title') }}</span>
                @endif
            </div>
            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" placeholder="Description" id="description" name="description"></textarea>
                @if ($errors->has('description'))
                    <span class="text-danger text-sm">{{ $errors->first('description') }}</span>
                @endif
            </div>
            {{-- Status (static single select) --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option selected disabled value="">Choose Option</option>
                    <option value="1">Publish</option>
                    <option value="0">Draft</option>
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
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
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
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    @endif
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
