<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    // ... index() dan create() TETAP SAMA ...
    public function index()
    {
        $recipes = Recipe::latest()->paginate(10);
        return view('admin.dashboard', compact('recipes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    // --- UPDATE 1: FUNCTION STORE ---
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'content' => 'required',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Recipe::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'category_id' => $request->category_id,
            'image' => 'images/' . $imageName,
            'description' => $request->description,
            'content' => $request->content,
            
            // FITUR PINTAR: Otomatis ambil ID dari link panjang
            'video_url' => $this->getYoutubeID($request->video_url), 
        ]);

        return redirect()->route('dashboard')->with('success', 'Resep berhasil ditambahkan!');
    }

    // ... edit() TETAP SAMA ...
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('admin.edit', compact('recipe', 'categories'));
    }

    // --- UPDATE 2: FUNCTION UPDATE ---
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        $data = $request->except(['image', 'video_url']); // Kecualikan video_url dulu

        // Proses Video URL (Otomatis ambil ID)
        if ($request->has('video_url')) {
            $data['video_url'] = $this->getYoutubeID($request->video_url);
        }

        if ($request->hasFile('image')) {
            $oldPath = public_path($recipe->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = 'images/' . $imageName;
        }

        $recipe->update($data);

        return redirect()->route('dashboard')->with('success', 'Resep berhasil diperbarui!');
    }

    // ... destroy() TETAP SAMA ...
    public function destroy(Recipe $recipe)
    {
        $imagePath = public_path($recipe->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $recipe->delete();
        return redirect()->route('dashboard')->with('success', 'Resep berhasil dihapus!');
    }

    // --- UPDATE 3: LOGIKA PEMISAH ID YOUTUBE ---
    // Tambahkan fungsi ini di paling bawah (sebelum kurung kurawal tutup terakhir)
    private function getYoutubeID($url)
    {
        if (!$url) return null;

        // Kalau user cuma masukkan ID pendek (misal: q9X1-i4h8kw), langsung pakai
        if (strlen($url) < 20) return $url;

        // Kalau user masukkan link panjang, kita ambil ID-nya
        // Contoh: https://www.youtube.com/watch?v=q9X1-i4h8kw
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        
        // Kembalikan ID-nya saja
        return $params['v'] ?? $url;
    }
}