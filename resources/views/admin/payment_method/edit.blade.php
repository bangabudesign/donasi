@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
</div>
<form action="{{ route('admin.payment_methods.update', $p_method->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card card-body">
        <div class="flex">
            <div class="mb-4 mr-4">                        
                <label class="form-label">IMAGE</label>
                <div class="overflow-hidden" style="height: 52px; width: 85px">
                    <img src="{{ $p_method->image_url }}" alt="image" class="rounded h-full w-full object-cover" id="imgPreview">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">&nbsp;</label>
                <input type="file" accept="image/*" class="form-control @error('image') invalid @enderror" name="image" id="fileInput">
                <p class="form-help">Ukuran yang disarankan 200px x 112px</p>
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror 
            </div>
        </div> 
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/2 p-4">             
                <div class="mb-4">
                    <label class="form-label">
                        Type
                    </label>
                    <div class="relative">
                        <select class="form-control @error('type') invalid @enderror" name="type" require>
                            <option value="BANKTRANSFER" {{ old('type', $p_method->type) == 'BANKTRANSFER' ? 'selected' : '' }}>BANKTRANSFER</option>
                            <option value="VIRTUALACCOUNT" {{ old('type', $p_method->type) == 'VIRTUALACCOUNT' ? 'selected' : '' }}>VIRTUALACCOUNT</option>
                            <option value="TUNAI" {{ old('type', $p_method->type) == 'TUNAI' ? 'selected' : '' }}>TUNAI</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('type')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Category
                    </label>
                    <div class="relative">
                        <select class="form-control @error('category') invalid @enderror" name="category" require>
                            <option value="BANK_TRANSFER" {{ old('category',$p_method->category) == 'BANK_TRANSFER' ? 'selected' : '' }}>BANK TRANSFER</option>
                            <option value="TUNAI" {{ old('category',$p_method->category) == 'TUNAI' ? 'selected' : '' }}>TUNAI</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('category')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Name
                    </label>
                    <input type="text" class="form-control @error('name') invalid @enderror" placeholder="Bank Pembangunan Daerah Kalimantan Selatan" name="name" value="{{ old('name', $p_method->name) }}" require>
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Short Name
                    </label>
                    <input type="text" class="form-control @error('short_name') invalid @enderror" placeholder="BPD KALSEL" name="short_name" value="{{ old('short_name', $p_method->short_name) }}" require>
                    @error('short_name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Detail 1
                    </label>
                    <input type="text" class="form-control @error('detail_1') invalid @enderror" placeholder="Bank Kalsel" name="detail_1" value="{{ old('detail_1', $p_method->detail_1) }}" require>
                    @error('detail_1')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Detail 2
                    </label>
                    <input type="text" class="form-control @error('detail_2') invalid @enderror" placeholder="123 456 xxx" name="detail_2" value="{{ old('detail_2', $p_method->detail_2) }}" require>
                    @error('detail_2')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Detail 3
                    </label>
                    <input type="text" class="form-control @error('detail_3') invalid @enderror" placeholder="Berkah Media Kreatif" name="detail_3" value="{{ old('detail_3', $p_method->detail_3) }}" require>
                    @error('detail_3')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror 
                </div>
            </div>
            <div class="w-full md:w-1/2 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Status
                    </label>
                    <div class="relative">
                        <select class="form-control @error('status') invalid @enderror" name="status" require>
                            <option value="">Choose...</option>
                            <option value="1" {{ old('status', $p_method->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $p_method->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-light mr-2">Close</a>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')

<script>
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