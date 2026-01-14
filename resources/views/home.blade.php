@extends('layouts.main')

@section('title', 'Beranda - Rasa Nusantara')

@section('content')

    <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden" 
             style="background-image: url('{{ asset('images/hero-banner.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 w-full px-6 lg:px-8">
            <div class="max-w-2xl">
                <h1 class="text-5xl lg:text-6xl font-light serif text-white mb-6 leading-tight">
                    Resep Sederhana Nusantara
                </h1>
                <p class="text-xl text-gray-100 mb-8 leading-relaxed font-light">
                    Temukan cita rasa autentik Indonesia melalui resep mudah dan ulasan makanan yang jujur dari hati ke hati.
                </p>
                <a href="#jelajahi" class="bg-primary text-white px-8 py-4 !rounded-button font-medium hover:bg-primary/90 transition-colors whitespace-nowrap inline-block">
                    Jelajahi Resep
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl serif font-semibold text-gray-900 mb-4">Konten Pilihan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Resep terpopuler yang paling dicintai pembaca kami</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featured as $item)
                <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col h-full border border-gray-100">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-sm text-yellow-600 font-medium mb-2 uppercase tracking-wider">{{ $item->category->name }}</span>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                            <a href="{{ route('recipe.show', $item->slug) }}" class="hover:text-primary transition-colors">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ $item->description }}
                        </p>
                        
                        <a href="{{ route('recipe.show', $item->slug) }}" 
                           class="mt-auto inline-flex items-center text-primary text-sm font-medium hover:underline">
                           Baca Selengkapnya <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="jelajahi" class="py-16 px-6 lg:px-8 bg-gray-50 min-h-[800px]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl serif font-semibold text-gray-900 mb-4">Jelajahi Resep</h2>
                <p class="text-lg text-gray-600">Cari resep favoritmu atau pilih berdasarkan kategori</p>
            </div>

            <div class="max-w-xl mx-auto mb-12 relative">
                <input type="text" 
                       id="search-input"
                       placeholder="Mau masak apa hari ini? (Contoh: Rendang...)" 
                       class="w-full px-6 py-4 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 pl-14 transition-all"
                       autocomplete="off">
                
                <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="ri-search-line text-xl"></i>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-12" id="category-buttons">
                <button onclick="filterCategory('')" 
                   class="category-btn bg-primary text-white border-primary px-6 py-3 rounded-full border transition-colors whitespace-nowrap flex items-center gap-2 font-medium">
                   Semua
                </button>

                @php
                    $kategoriList = [
                        ['slug' => 'sarapan', 'icon' => 'ri-sun-line', 'label' => 'Sarapan'],
                        ['slug' => 'dessert', 'icon' => 'ri-cake-3-line', 'label' => 'Dessert'],
                        ['slug' => 'minuman', 'icon' => 'ri-cup-line', 'label' => 'Minuman'],
                        ['slug' => 'sehat', 'icon' => 'ri-heart-pulse-line', 'label' => 'Sehat'],
                        ['slug' => 'asian', 'icon' => 'ri-bowl-line', 'label' => 'Asian'],
                        ['slug' => 'review-makanan', 'icon' => 'ri-restaurant-line', 'label' => 'Review'],
                    ];
                @endphp

                @foreach($kategoriList as $kat)
                <button onclick="filterCategory('{{ $kat['slug'] }}', this)" 
                   class="category-btn bg-white text-gray-700 border-gray-200 hover:border-primary hover:text-primary px-6 py-3 rounded-full border transition-colors whitespace-nowrap flex items-center gap-2 font-medium">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="{{ $kat['icon'] }} text-lg"></i>
                    </div>
                    {{ $kat['label'] }}
                </button>
                @endforeach
            </div>

            <div id="search-results" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 transition-opacity duration-300">
                @foreach($latest as $item)
                <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden group border border-gray-100">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-yellow-600 font-bold uppercase tracking-wide">{{ $item->category->name }}</span>
                        <h3 class="text-lg font-semibold text-gray-900 mt-2 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                            <a href="{{ route('recipe.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">{{ $item->description }}</p>
                        <a href="{{ route('recipe.show', $item->slug) }}" class="inline-flex items-center text-primary text-sm font-medium hover:underline">
                            Lihat Resep <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div id="loading" class="hidden text-center py-12">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-primary border-t-transparent"></div>
                <p class="mt-2 text-gray-500">Mencari resep lezat...</p>
            </div>
            
            <div id="empty-state" class="hidden text-center py-12">
                <i class="ri-fridge-line text-6xl text-gray-300 mb-4 block"></i>
                <p class="text-gray-500 text-lg">Maaf, resep yang kamu cari belum ada di dapur kami.</p>
            </div>

            <div class="mt-12 flex justify-center" id="default-pagination">
                {{ $latest->appends(['search' => request('search'), 'category' => request('category')])->fragment('jelajahi')->links() }}
            </div>
        </div>
    </section>

    <script>
        let typingTimer;
        let currentCategory = '';

        // Event saat mengetik
        document.getElementById('search-input').addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            let query = this.value;
            
            // Delay 500ms agar tidak spam request
            typingTimer = setTimeout(() => {
                fetchRecipes(query, currentCategory);
            }, 500);
        });

        // Event saat klik kategori
        function filterCategory(slug, btnElement) {
            currentCategory = slug;
            
            // Reset style semua tombol
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.className = 'category-btn bg-white text-gray-700 border-gray-200 hover:border-primary hover:text-primary px-6 py-3 rounded-full border transition-colors whitespace-nowrap flex items-center gap-2 font-medium';
            });
            
            // Highlight tombol aktif
            if(btnElement) {
                btnElement.className = 'category-btn bg-primary text-white border-primary px-6 py-3 rounded-full border transition-colors whitespace-nowrap flex items-center gap-2 font-medium';
            } else {
                // Tombol "Semua"
                document.querySelector('.category-btn').className = 'category-btn bg-primary text-white border-primary px-6 py-3 rounded-full border transition-colors whitespace-nowrap flex items-center gap-2 font-medium';
            }

            // Jalankan pencarian
            let query = document.getElementById('search-input').value;
            fetchRecipes(query, currentCategory);
        }

        // Fungsi Ambil Data ke Server (AJAX)
        function fetchRecipes(search, category) {
            const resultsDiv = document.getElementById('search-results');
            const loadingDiv = document.getElementById('loading');
            const emptyDiv = document.getElementById('empty-state');
            const paginationDiv = document.getElementById('default-pagination');

            // UI Loading state
            resultsDiv.classList.add('opacity-50');
            loadingDiv.classList.remove('hidden');
            emptyDiv.classList.add('hidden');
            if(paginationDiv) paginationDiv.style.display = 'none'; // Sembunyikan pagination bawaan saat search

            // Panggil API Laravel
            fetch(`{{ route('api.recipes.search') }}?search=${search}&category=${category}`)
                .then(response => response.json())
                .then(data => {
                    loadingDiv.classList.add('hidden');
                    resultsDiv.classList.remove('opacity-50');
                    resultsDiv.innerHTML = '';

                    if (data.length === 0) {
                        emptyDiv.classList.remove('hidden');
                    } else {
                        // Loop data dan buat HTML Card
                        data.forEach(item => {
                            // Fix gambar: Pastikan tidak double slash
                            let imagePath = item.image.startsWith('http') ? item.image : `/${item.image}`;
                            imagePath = imagePath.replace('//', '/');

                            let card = `
                            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden group border border-gray-100">
                                <div class="h-48 overflow-hidden relative">
                                    <img src="${imagePath}" alt="${item.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-6">
                                    <span class="text-xs text-yellow-600 font-bold uppercase tracking-wide">${item.category_name}</span>
                                    <h3 class="text-lg font-semibold text-gray-900 mt-2 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                        <a href="/resep/${item.slug}">${item.title}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">${item.description}</p>
                                    <a href="/resep/${item.slug}" class="inline-flex items-center text-primary text-sm font-medium hover:underline">
                                        Lihat Resep <i class="ri-arrow-right-line ml-1"></i>
                                    </a>
                                </div>
                            </article>
                            `;
                            resultsDiv.innerHTML += card;
                        });
                    }
                });
        }
    </script>

    <section class="py-20 px-6 lg:px-8 bg-yellow-50/50">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl serif font-semibold text-gray-900 mb-4">
                Dapatkan Resep Terbaru di Email Anda
            </h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan food lover Indonesia yang sudah merasakan kelezatan resep pilihan kami setiap minggu.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Masukkan email Anda" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                <button class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition-colors whitespace-nowrap shadow-sm">
                    Berlangganan
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-4">
                Gratis dan bisa berhenti berlangganan kapan saja.
            </p>
        </div>
    </section>

@endsection