@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">Dashboard</h2>
    </div>
</div>
<div class="flex flex-wrap -mx-6">
    <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                <svg class="fill-current h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zm8 0a3 3 0 11-6 0 3 3 0 016 0zm-4.07 11c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
            </div>

            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $contributors }}</h4>
                <div class="text-gray-500">Contributors</div>
            </div>
        </div>
    </div>

    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                <svg class="fill-current h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            </div>

            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $donation }}</h4>
                <div class="text-gray-500">Donasi Terkumpul </div>
            </div>
        </div>
    </div>

    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                <svg class="fill-current h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            </div>

            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $zakat }}</h4>
                <div class="text-gray-500">Zakat Terkumpul </div>
            </div>
        </div>
    </div>
</div>
@endsection