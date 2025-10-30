@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($chapters as $chapter)
        @if ($chapter->story)
        <url>
            <loc>{{ route('chapter', ['storySlug' => $chapter->story->slug, 'chapterSlug' => $chapter->slug]) }}</loc>
            <lastmod>{{ $chapter->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
        @endif
    @endforeach
</urlset>