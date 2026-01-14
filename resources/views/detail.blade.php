@extends('layouts.main')

@section('title', $recipe->title . ' - Rasa Nusantara')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
        <span class="text-primary font-bold uppercase tracking-wider">{{ $recipe->category->name }}</span>
        <span>•</span>
        <span>{{ $recipe->created_at->format('d F Y') }}</span>
    </div>

    <h1 class="text-4xl md:text-5xl font-[Arial] font-bold text-gray-900 mb-8 leading-tight">
        {{ $recipe->title }}
    </h1>

    @if($recipe->video_url)
        <div class="mb-8 rounded-xl overflow-hidden shadow-lg aspect-w-16 aspect-h-9">
        <iframe 
            src="https://www.youtube.com/embed/{{ $recipe->video_url }}" 
            class="absolute top-0 left-0 w-full h-full rounded-2xl shadow-lg"
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
        </div>
        @else
        <div class="aspect-w-16 aspect-h-9 mb-10 font-[Arial] rounded-xl overflow-hidden shadow-lg">
        <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover">
        </div>
        @endif

    <div class="aspect-w-16 aspect-h-9 mb-10 font-[Arial] rounded-xl overflow-hidden shadow-lg">
    <img src="{{ asset($recipe->image) }}"alt="{{ $recipe->title }}" class="w-full h-full object-cover">
    </div>

    <div class="prose prose-lg font-[Arial] max-w-none text-gray-700 leading-relaxed">
        <p class="text-xl font-light text-gray-600 mb-8 border-l-4 border-primary pl-4 italic">
            "{{ $recipe->description }}"
        </p>
        
        <div class="recipe-content font-[Arial]">
            {!! $recipe->content !!}
        </div>
    </div>

    <div class="mt-12 pt-8 border-t border-gray-100">
    <a href="{{ route('home') }}" 
       class="inline-flex items-center px-6 py-3 rounded-button border border-gray-200 text-gray-600 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all duration-300 group">
        <i class="ri-arrow-left-line mr-2 group-hover:-translate-x-1 transition-transform"></i> 
        Kembali ke Beranda
    </a>
    </div>

    <section class="max-w-4xl mx-auto px-6 lg:px-8 py-12 border-t border-gray-100">
        <h3 class="text-2xl font-arial font-bold text-gray-900 mb-8">Diskusi & Komentar</h3>

        @auth
            <form action="{{ route('comment.store', $recipe->slug) }}" method="POST" class="mb-12">
                @csrf
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-700 font-bold shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <textarea name="body" rows="3" class="w-full border-gray-300 rounded-xl focus:ring-yellow-500 focus:border-yellow-500 p-4" placeholder="Tulis tanggapanmu tentang resep ini..."></textarea>
                        <button type="submit" class="mt-2 bg-primary text-white px-6 py-2 rounded-lg font-medium hover:bg-primary/90 transition-colors">
                            Kirim Komentar
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="bg-gray-50 p-6 rounded-xl text-center mb-12 border border-gray-200">
                <p class="text-gray-600">Silakan <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk</a> untuk menulis komentar.</p>
            </div>
        @endauth

        <div class="space-y-8">
            @forelse($recipe->comments as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-bold shrink-0">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    
                    <div class="flex-1">
                        <div class="bg-gray-50 p-4 rounded-xl rounded-tl-none">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-bold text-gray-900">{{ $comment->user->name }}</h5>
                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $comment->body }}</p>
                        </div>

                        @auth
                            <button onclick="document.getElementById('reply-{{ $comment->id }}').classList.toggle('hidden')" class="text-sm text-primary font-medium mt-2 hover:underline">
                                Balas
                            </button>
                        @endauth

                        <form id="reply-{{ $comment->id }}" action="{{ route('comment.store', $recipe->slug) }}" method="POST" class="hidden mt-4 ml-4">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="flex gap-3">
                                <textarea name="body" rows="2" class="w-full border-gray-300 rounded-lg text-sm p-3" placeholder="Balas komentar ini..."></textarea>
                                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm self-end">Kirim</button>
                            </div>
                        </form>

                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-4 ml-4 pl-4 border-l-2 border-gray-200">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 rounded-full {{ $reply->user->name == 'Admin' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h6 class="font-bold text-sm {{ $reply->user->name == 'Admin' ? 'text-primary' : 'text-gray-900' }}">
                                                    {{ $reply->user->name }}
                                                    @if($reply->user->name == 'Admin') <span class="bg-primary text-white text-[10px] px-1.5 py-0.5 rounded ml-1">ADMIN</span> @endif
                                                </h6>
                                                <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm mt-1">{{ $reply->body }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">Belum ada komentar. Jadilah yang pertama!</p>
            @endforelse
        </div>
    </section>
</div>
@endsection