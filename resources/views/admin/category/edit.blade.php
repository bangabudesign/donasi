@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
</div>
@if (session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif
<form action="{{ route('admin.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="flex flex-wrap -m-3">
        <div class="md:w-4/6 p-3">
            <div class="card card-body">
                <div class="mb-4">
                    <label class="form-label">
                        Name
                    </label>
                    <input type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ old('name',$category->name) }}" required>
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Slug
                    </label>
                    <input type="text" class="form-control @error('slug') invalid @enderror" name="slug" value="{{ old('slug',$category->slug) }}" required>
                    @error('slug')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Description
                    </label>
                    <textarea class="form-control @error('description') invalid @enderror" name="description" id="editor">{{ old('description',$category->description) }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div> 
            </div>
        </div>
        <div class="md:w-2/6 p-3">
            <div class="card card-body">
                <div class="-m-6 mb-6">
                    <img src="{{ $category->image ? url('/',$category->image) : 'https://via.placeholder.com/1080X400' }}" alt="fatured_image" class="w-full" id="imgPreview">
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Featured Image
                    </label>
                    <input type="file" accept="image/*" class="form-control @error('image') invalid @enderror" name="image" id="fileInput">
                    <p class="form-help">Ukuran yang disarankan 1080px x 400px</p>
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light mr-2">Close</a>
                    <button class="btn btn-primary" type="submit">Save</button>
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