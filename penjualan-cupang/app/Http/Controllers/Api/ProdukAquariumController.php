<?php

namespace App\Http\Controllers\Api;

use App\Models\ProdukAquarium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ProdukAquariumController extends Controller
{
    // Method untuk mendapatkan semua produk
    public function index() {
        // Mengembalikan semua produk dalam format JSON
        return response()->json(ProdukAquarium::all());
    }

    // Method untuk menambah produk baru
    public function store(Request $request) {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        // Cek apakah file gambar ada
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder produk_aquarium di dalam folder public/storage
            $data['image'] = asset('storage/' . $request->file('image')->store('produk_aquarium', 'public'));

        } else {
            // Jika tidak ada gambar, kirimkan log atau response error
            Log::error('No image file received');
            return response()->json([
                'success' => false,
                'message' => 'Image file is required',
            ], 400);
        }

        // Simpan produk baru ke database
        $produk = ProdukAquarium::create($data);

        // Kembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk aquarium berhasil ditambahkan',
            'data' => $produk,
        ], 201);
    }

    public function show($id) {
        // Mencari produk berdasarkan ID
        $produk = ProdukAquarium::findOrFail($id);
    
        // Menambahkan URL lengkap untuk gambar
        $produk->image = asset('storage/' . $produk->image);
    
        // Mengembalikan produk dalam format JSON
        return response()->json($produk);
    }
    

    // Method untuk memperbarui produk
    public function update(Request $request, $id) {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        // Mencari produk berdasarkan ID
        $produk = ProdukAquarium::findOrFail($id);

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
                unlink(public_path('storage/' . $produk->image)); // Menghapus gambar lama
            }

            // Simpan gambar baru
            $data['image'] = asset('storage/' . $request->file('image')->store('produk_aquarium', 'public'));
        }

        // Memperbarui produk dengan data baru
        $produk->update($data);

        // Mengembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk aquarium berhasil diperbarui',
            'data' => $produk,
        ]);
    }

    // Method untuk menghapus produk
    public function destroy($id) {
        // Mencari produk berdasarkan ID
        $produk = ProdukAquarium::findOrFail($id);

        // Menghapus gambar jika ada
        if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
            unlink(public_path('storage/' . $produk->image));
        }

        // Menghapus produk dari database
        $produk->delete();

        // Mengembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk aquarium berhasil dihapus',
        ]);
    }
}
