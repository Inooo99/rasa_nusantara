<footer id="footer" class="bg-white border-t border-gray-100 py-16 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <div>
            <a href="{{ route('home') }}" class="block text-xl font-semibold text-primary mb-4 hover:underline">
                Rasa Nusantara
            </a>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Berbagi cinta kuliner Indonesia melalui resep autentik dan review makanan yang jujur.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-900 mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition-colors">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#jelajahi" class="text-gray-600 hover:text-primary transition-colors">Resep</a>
                    </li>
                    <li>
                        <a href="{{ route('home', ['category' => 'review-makanan']) }}#jelajahi" class="text-gray-600 hover:text-primary transition-colors">Review Makanan</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#jelajahi" class="text-gray-600 hover:text-primary transition-colors">Kategori</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-primary hover:text-white transition-colors rounded-full">
                        <i class="ri-instagram-line text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-primary hover:text-white transition-colors rounded-full">
                        <i class="ri-facebook-line text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-primary hover:text-white transition-colors rounded-full">
                        <i class="ri-youtube-line text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-primary hover:text-white transition-colors rounded-full">
                        <i class="ri-tiktok-line text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                © {{ date('Y') }} Rasa Nusantara. Semua hak dilindungi undang-undang.
            </p>
        </div>
    </div>
</footer>

<script id="mobile-menu-script">
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('button[class*="md:hidden"]');
        const nav = document.querySelector('nav');
        
        if (menuButton) {
            menuButton.addEventListener('click', function() {
                let menu = document.getElementById('mobile-menu-items');
                
                if (!menu) {
                    // Render Menu jika belum ada
                    const menuHTML = `
                        <div id="mobile-menu-items" class="md:hidden absolute top-full left-0 right-0 bg-white border-b border-gray-100 shadow-lg transition-all duration-300 opacity-0 -translate-y-2 hidden">
                            <div class="px-6 py-4 space-y-4">
                                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-primary font-medium">Beranda</a>
                                <a href="{{ route('home') }}#jelajahi" class="block text-gray-700 hover:text-primary font-medium">Resep</a>
                                <a href="{{ route('home', ['category' => 'review-makanan']) }}#jelajahi" class="block text-gray-700 hover:text-primary font-medium">Review Makanan</a>
                                <a href="{{ route('home') }}#jelajahi" class="block text-gray-700 hover:text-primary font-medium">Kategori</a>
                                <a href="#footer" class="block text-gray-700 hover:text-primary font-medium">Tentang</a>
                                <a href="#footer" class="block text-gray-700 hover:text-primary font-medium">Kontak</a>
                            </div>
                        </div>
                    `;
                    nav.insertAdjacentHTML('beforeend', menuHTML);
                    menu = document.getElementById('mobile-menu-items');
                }

                // Logika Animasi Toggle
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    // Timeout kecil agar transisi CSS berjalan
                    setTimeout(() => { 
                        menu.style.opacity = '1'; 
                        menu.style.transform = 'translateY(0)'; 
                    }, 10);
                } else {
                    menu.style.opacity = '0'; 
                    menu.style.transform = 'translateY(-10px)';
                    // Tunggu animasi selesai baru hidden
                    setTimeout(() => { 
                        menu.classList.add('hidden'); 
                    }, 300);
                }
            });
        }
    });
</script>

<script id="newsletter-form">
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.querySelector('input[type="email"]');
        const subBtn = emailInput?.nextElementSibling; // Tombol Berlangganan
        
        if (subBtn && emailInput) {
            subBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah reload halaman
                
                const email = emailInput.value;
                const originalText = subBtn.innerText;

                // Validasi sederhana di depan
                if (!email || !email.includes('@')) {
                    alert('Mohon masukkan alamat email yang valid.');
                    return;
                }

                // Ubah tombol jadi "Loading..."
                subBtn.innerText = 'Menyimpan...';
                subBtn.disabled = true;

                // Kirim ke Laravel
                fetch("{{ route('subscribe') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Token keamanan wajib Laravel
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Email mungkin sudah terdaftar.');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message); // Tampilkan pesan sukses dari server
                    emailInput.value = ''; // Kosongkan input
                })
                .catch(error => {
                    alert('Gagal: ' + error.message);
                })
                .finally(() => {
                    // Kembalikan tombol seperti semula
                    subBtn.innerText = originalText;
                    subBtn.disabled = false;
                });
            });
        }
    });
</script>