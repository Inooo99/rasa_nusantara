@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 serif">Daftar Resep</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola semua resep masakan di sini.</p>
    </div>
    <a href="{{ route('dashboard.create') }}" class="bg-yellow-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-yellow-700 transition-colors flex items-center gap-2">
        <i class="ri-add-line text-xl"></i> Tambah Resep
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-900 font-semibold uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Judul Resep</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($recipes as $index => $recipe)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">{{ $index + $recipes->firstItem() }}</td>
                    
                    <td class="px-6 py-4">
                        <img src="{{ asset($recipe->image) }}" alt="Img" class="w-12 h-12 rounded object-cover border border-gray-200">
                    </td>
                    
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $recipe->title }}</td>
                    
                    <td class="px-6 py-4">
                        <span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $recipe->category->name }}
                        </span>
                    </td>
                    
                    <td class="px-6 py-4">Admin</td> 
                    
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('dashboard.edit', $recipe->id) }}" class="w-8 h-8 flex items-center justify-center rounded bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                <i class="ri-pencil-line"></i>
                            </a>
                            
                            <form action="{{ route('dashboard.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Hapus">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $recipes->links() }}
    </div>
</div>
@endsection