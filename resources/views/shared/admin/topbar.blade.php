<div class="top-bar fixed w-full bg-white shadow z-40">
    <div class="w-full px-6 py-4 h-16 flex items-center justify-between border-b-4 border-green-500">
        <div class="cursor-pointer">
            <svg class="stroke-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/></svg>
        </div>
        <figure class="cursor-pointer flex">
            <figcaption class="my-auto mr-3">{{ auth()->user()->name ?? 'Nama User' }}</figcaption>
            <img class="my-auto h-10 w-10 rounded-full" src="{{ auth()->user()->profile_photo ?? 'Nama User' }}" alt="Avatar">
        </figure>
    </div>
</div>