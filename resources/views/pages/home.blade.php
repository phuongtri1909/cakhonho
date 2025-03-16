@extends('layouts.app')
@section('title',  'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))
@section('description', 'Nơi đây là thế giới của những câu chuyện ngôn tình mang chiều sâu có H văn. Những câu chuyện về những cặp đôi lạc lối trong chính trái tim mình, loay hoay giữa yêu thương và dằn vặt, để rồi sau tất cả, họ nhận ra tình yêu thật sự luôn tồn tại trong chính họ. Nếu bạn cũng thích những mối quan hệ loay hoay trong bản ngã để rồi thức tỉnh rằng tình yêu vẫn luôn ở sâu trong tâm khảm linh hồn- chào mừng bạn đã đến đây.')
@section('keyword', 'hanlamngoc, hanlamngoc.com,  đọc truyện online, truyện miễn phí, truyện hot, truyện mới cập nhật, truyện full, truyện hoàn thành, đọc truyện chữ, web đọc truyện, novel, light novel, kho truyện online, truyện hay, truyện tiên hiệp, truyện kiếm hiệp, ngôn tình, đam mỹ, truyện teen, truyện xuyên không')


@section('content')
    <section class="container-xl">
        @include('components.list_story_home', ['list_story' => $hotStories])
        @include('components.list_story_new',['newStories' => $newStories])
        @include('components.list_story_full',['completedStories' => $completedStories])
    </section>
   
@endsection

@push('styles')
  
@endpush

@push('scripts')

@endpush
