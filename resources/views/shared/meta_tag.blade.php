<!-- Primary Meta Tags -->
<title>{{ $meta_title ?? config('app.name') }}</title>
<meta name="title" content="{{ $meta_title ?? config('app.name') }}">
<meta name="description" content="{{ $meta_description ?? config('app.description') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $meta_title ?? config('app.name') }}">
<meta property="og:description" content="{{ $meta_description ?? config('app.description') }}">
<meta property="og:image" content="{{ $meta_image ?? '' }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $meta_title ?? config('app.name') }}">
<meta property="twitter:description" content="{{ $meta_description ?? config('app.description') }}">
<meta property="twitter:image" content="{{ $meta_image ?? '' }}">