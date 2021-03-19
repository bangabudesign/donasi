@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
</div>
<form action="{{ route('admin.donations.update', $donation->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card card-body">
        <div class="mb-4">
            <label class="form-label">
                Select Campaign
            </label>
            <div class="relative">
                <select class="form-control @error('campaign_id') invalid @enderror" name="campaign_id" required>
                    <option value="">Choose...</option>
                    @forelse ($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ old('campaign_id', $donation->campaign_id) == $campaign->id ? 'selected' : '' }}>{{ $campaign->code.' - '.Helper::truncate($campaign->title,20,'...') }}</option>
                    @empty
                    <option value="">No data</option>
                    @endforelse
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('campaign_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror                    
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Select User
                    </label>
                    <div class="relative">
                        <select class="form-control @error('user_id') invalid @enderror" name="user_id" required>
                            <option value="">Choose...</option>
                            @forelse ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $donation->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @empty
                            <option value="">No data</option>
                            @endforelse
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('user_id')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Amount
                    </label>
                    <div class="relative">
                        <input type="number" class="form-control text-right @error('amount') invalid @enderror" name="amount" value="{{ old('amount', $donation->amount) }}" required>
                        <span class="form-prepend">Rp</span>
                    </div>
                    @error('amount')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                  
                </div> 
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">Hamba Allah</label>
                    <div class="pt-2">
                        <div class="toggle">
                            <input type="checkbox" name="is_anonim" id="toggle" value="1" class="toggle-checkbox" {{ old('is_anonim', $donation->is_anonim) == 1 ? 'checked' : '' }}/>
                            <label for="toggle" class="toggle-label"></label>
                        </div>
                    </div>
                </div> 
            </div>
        </div>                              
        <div class="mb-4">
            <label class="form-label">
                TULIS DO'A DAN DUKUNGAN (opsional)
            </label>
            <textarea class="form-control @error('comment') invalid @enderror" name="comment" placeholder="Beri do'a dan dukunganmu disini" rows="4">{{ old('comment', $donation->comment) }}</textarea>
            @error('comment')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="form-label">Status</label>
            <div class="relative">
                <select class="form-control @error('status') invalid @enderror" name="status" required>
                    <option value="">Choose...</option>
                    <option value="1" {{ old('status', $donation->status) == '1' ? 'selected' : '' }}>Success</option>
                    <option value="0" {{ old('status', $donation->status) == '0' ? 'selected' : '' }}>Cancel</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('status')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror                    
        </div>
        <hr class="mb-6 border-gray-400">
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/3 p-4">    
                <div class="mb-4">
                    <label class="form-label">
                        Payment Method
                    </label>
                    <div class="relative">
                        <select class="form-control @error('payment_method_id') invalid @enderror" name="payment_method_id" required>
                            <option value="">Choose...</option>
                            @forelse ($methods as $method)
                            <option value="{{ $method->id }}" {{ old('payment_method_id', $donation->payment_method_id) == $method->id ? 'selected' : '' }}>{{ $method->short_name }}</option>
                            @empty
                            <option value="">No data</option>
                            @endforelse
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('payment_method_id')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div> 
            </div>
            <div class="w-full md:w-1/3 p-4">    
                <div class="mb-4">
                    <label class="form-label">
                        Payment Status
                    </label>
                    <div class="relative">
                        <select class="form-control @error('payment_status') invalid @enderror" name="payment_status">
                            <option value="">Choose...</option>
                            <option value="0" {{ old('payment_status', $donation->payment_status) == '0' ? 'selected' : '' }}>UNPAID</option>
                            <option value="1" {{ old('payment_status', $donation->payment_status) == '1' ? 'selected' : '' }}>PAID</option>
                            <option value="2" {{ old('payment_status', $donation->payment_status) == '2' ? 'selected' : '' }}>PENDING</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('payment_status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">Payment Date</label>
                    <input type="datetime-local" class="form-control @error('payment_date') invalid @enderror" name="payment_date" value="{{ old('payment_date', date("Y-m-d",strtotime($donation->payment_date)).'T'.date("H:i",strtotime($donation->payment_date))) }}">
                    @error('payment_date')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                  
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">Atas Nama Rekening</label>
                    <input type="text" class="form-control @error('payment_detail_1') invalid @enderror" name="payment_detail_1" value="{{ old('payment_detail_1', $donation->payment_detail_1) }}">
                    @error('payment_detail_1')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                  
                </div> 
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">Nama Bank</label>
                    <input type="payment_detail_2" class="form-control @error('payment_detail_2') invalid @enderror" name="payment_detail_2" value="{{ old('payment_detail_2', $donation->payment_detail_2) }}">
                    @error('payment_detail_2')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                  
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Catatan (opsional)</label>
            <textarea class="form-control @error('payment_detail_3') invalid @enderror" name="payment_detail_3" placeholder="Beri keterangan tambahan disini" rows="4">{{ old('payment_detail_3', $donation->payment_detail_3) }}</textarea>
            @error('payment_detail_3')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror                 
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">Verified At</label>
                    <input type="datetime-local" class="form-control @error('verified_at') invalid @enderror" name="verified_at" value="{{ old('verified_at', date("Y-m-d",strtotime($donation->verified_at)).'T'.date("H:i",strtotime($donation->verified_at))) }}">
                    @error('verified_at')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                  
                </div> 
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="mb-4">
                    <label class="form-label">
                        Verified By
                    </label>
                    <div class="relative">
                        <select class="form-control @error('verified_by') invalid @enderror" name="verified_by">
                            <option value="">Choose...</option>
                            @forelse ($admins as $admin)
                            <option value="{{ $admin->id }}" {{ old('verified_by', $donation->verified_by) == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                            @empty
                            <option value="">No data</option>
                            @endforelse
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('verified_by')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror                    
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.donations.index') }}" class="btn btn-light mr-2">Close</a>
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection