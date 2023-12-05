<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlse xmlns="http://wwww.sitemaps.org/schemas/sitemap/0.9">
    @foreach($courses as $course)
    <url>
        <loc>{{url('/')}}/course/list/{{$course->slug}}</loc>
        <lastmod>{{ $course->created_at->tz('Asia/Ho_Chi_Minh')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
</urlse>