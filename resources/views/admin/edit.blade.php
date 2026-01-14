@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 serif">Edit Resep</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <form action="{{ route('dashboard.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Resep</label>
                <input type="text" name="title" value="{{ $recipe->title }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Makanan (Biarkan kosong jika tidak ganti)</label>
            <div class="flex items-center gap-4 mb-2">
                <img src="{{ asset($recipe->image) }}" class="w-16 h-16 rounded object-cover border">
                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Link Youtube / ID</label>
            <input type="text" name="video_url" value="{{ $recipe->video_url }}" placeholder="Contoh: https://www.youtube.com/watch?v=..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
            <p class="text-xs text-gray-500 mt-1">Bisa isi Link Lengkap atau ID saja.</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>{{ $recipe->description }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Resep Lengkap</label>
            <textarea name="content" rows="10" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 font-mono text-sm" required>{{ $recipe->content }}</textarea>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Batal</a>
            <button type="submit" class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 font-medium">Update Resep</button>
        </div>
    </form>
</div>
@endsection