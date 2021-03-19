@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
</div>
<form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-wrap -m-3">
        <div class="md:w-4/6 p-3">
            <div class="card card-body">
                <div class="mb-4">
                    <label class="form-label">
                        Title
                    </label>
                    <input type="text" class="form-control @error('title') invalid @enderror" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Slug
                    </label>
                    <input type="text" class="form-control @error('slug') invalid @enderror" name="slug" value="{{ old('slug') }}" required>
                    @error('slug')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="">
                    <label class="form-label">
                        Body
                    </label>
                    <textarea class="form-control @error('body') invalid @enderror" name="body" id="editor">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
        </div>
        <div class="md:w-2/6 p-3">
            <div class="card card-body">
                <div class="-m-6 mb-6">
                    <img src="http://placehold.it/400X225" alt="fatured_image" class="w-full" id="imgPreview">
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Featured Image
                    </label>
                    <input type="file" accept="image/*" class="form-control @error('featured_image') invalid @enderror" name="featured_image" id="fileInput">
                    <p class="form-help">Ukuran yang disarankan 400px x 225px</p>
                    @error('featured_image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Published at
                    </label>
                    <input type="date" class="form-control @error('published_at') invalid @enderror" name="published_at" value="{{ old('published_at') }}" required>
                    @error('published_at')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Status
                    </label>
                    <div class="relative">
                        <select class="form-control @error('status') invalid @enderror" name="status" required>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-light mr-2">Close</a>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')

<link href="{{ asset('backend/css/editor.css') }}" rel="stylesheet">

@endpush

@push('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        }
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    // image preview
    const fileReader = new FileReader();
    const fileInput = document.getElementById("fileInput");
    const imgPreview = document.getElementById("imgPreview");
    let file;

    fileReader.onload = e => {
    imgPreview.src = e.target.result;
    }

    fileInput.addEventListener('change', e => {
    const f = e.target.files[0];
    file = f;
    fileReader.readAsDataURL(f);
    })
</script>

@endpush