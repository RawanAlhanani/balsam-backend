<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | جمعية بلسم لذوي التوحد</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:site_name" content="جمعية بلسم لذوي التوحد">
    <meta property="og:locale" content="ar_AR">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:secure_url" content="{{ $image }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $title }}">
    @if($published)
    <meta property="article:published_time" content="{{ $published->toIso8601String() }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image }}">

    {{-- JS only (no meta refresh): crawlers ignore it and keep these tags, people go to the real page. --}}
    <script>window.location.replace(@json($canonical));</script>
</head>
<body style="font-family:Tahoma,Arial,sans-serif;margin:0;padding:40px 20px;background:#f3f8fa;color:#12303f;text-align:center">
    <h1 style="font-size:24px;margin:0 0 12px">{{ $title }}</h1>
    <p style="max-width:560px;margin:0 auto 20px;line-height:1.8">{{ $description }}</p>
    <a href="{{ $canonical }}" style="color:#0d5377;font-weight:bold">فتح الصفحة على موقع جمعية بلسم</a>
</body>
</html>
