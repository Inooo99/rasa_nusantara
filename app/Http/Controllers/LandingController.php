<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Comment;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil 6 resep acak untuk "Konten Pilihan" (Tetap seperti sebelumnya)
        $featured = Recipe::inRandomOrder()->limit(6)->get();

        // 2. Logika Pencarian & Filter untuk "Artikel Terbaru"
        $query = Recipe::query();

        // A. Jika ada pencarian (ketik di kolom search)
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // B. Jika ada klik tombol Kategori
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Ambil data (dengan Pagination 9 per halaman)
        $latest = $query->latest()->paginate(9)->withQueryString(); // withQueryString() agar filter tidak hilang saat ganti halaman

        // Kirim data ke View
        return view('home', compact('featured', 'latest'));
    }

    // Fungsi untuk membuka detail resep (Halaman Single)
    public function show($slug)
    {
        // Cari resep berdasarkan slug (judul-yang-ada-stripnya)
        $recipe = Recipe::where('slug', $slug)->firstOrFail();

        return view('detail', compact('recipe'));
    }
    public function subscribe(Request $request)
    {
        // Validasi: Email wajib ada, harus format email, dan belum terdaftar
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        // Simpan ke database
        Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json(['message' => 'Terima kasih! Anda berhasil berlangganan.']);
    }

    //fungsi untuk menambah komentar
    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'body' => 'required|min:3'
        ]);

        $recipe = Recipe::where('slug', $slug)->firstOrFail();

        Comment::create([
            'user_id' => auth()->id(), // Ambil ID user yg sedang login
            'recipe_id' => $recipe->id,
            'parent_id' => $request->parent_id, // Null jika komentar baru, Terisi jika balasan
            'body' => $request->body
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}