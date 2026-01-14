<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Rasa Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-yellow-600 serif mb-2">Rasa Nusantara</h1>
            <p class="text-gray-500">Silakan masuk untuk mengelola resep.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition-all"
                    placeholder="admin@example.com">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-yellow-600 text-white font-bold py-3 rounded-lg hover:bg-yellow-700 transition-colors shadow-lg shadow-yellow-600/20">
                Masuk Dashboard
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-yellow-600 transition-colors">&larr; Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>