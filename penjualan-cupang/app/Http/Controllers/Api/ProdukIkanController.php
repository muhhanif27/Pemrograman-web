<?php

namespace App\Http\Controllers\Api;

use App\Models\ProdukIkan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ProdukIkanController extends Controller
{
    // Method untuk mendapatkan semua produk ikan
    public function index() {
        // Mengembalikan semua produk ikan dalam format JSON
        return response()->json(ProdukIkan::all());
    }

    // Method untuk menambah produk ikan baru
    public function store(Request $request) {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        // Cek apakah file gambar ada
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder produk_ikan di dalam folder public/storage
            $data['image'] = asset('storage/' . $request->file('image')->store('produk_ikan', 'public'));
        } else {
            // Jika tidak ada gambar, kirimkan log atau response error
            Log::error('No image file received');
            return response()->json([
                'success' => false,
                'message' => 'Image file is required',
            ], 400);
        }

        // Simpan produk ikan baru ke database
        $produk = ProdukIkan::create($data);

        // Kembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil ditambahkan',
            'data' => $produk,
        ], 201);
    }

    // Method untuk melihat produk ikan berdasarkan ID
    public function show($id) {
        // Mencari produk ikan berdasarkan ID
        $produk = ProdukIkan::findOrFail($id);

        // Menambahkan URL lengkap untuk gambar
        $produk->image = asset('storage/' . $produk->image);

        // Mengembalikan produk dalam format JSON
        return response()->json($produk);
    }

    // Method untuk memperbarui produk ikan
    public function update(Request $request, $id) {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        // Mencari produk ikan berdasarkan ID
        $produk = ProdukIkan::findOrFail($id);

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
                unlink(public_path('storage/' . $produk->image)); // Menghapus gambar lama
            }

            // Simpan gambar baru
            $data['image'] = asset('storage/' . $request->file('image')->store('produk_ikan', 'public'));
        }

        // Memperbarui produk dengan data baru
        $produk->update($data);

        // Mengembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil diperbarui',
            'data' => $produk,
        ]);
    }

    // Method untuk menghapus produk ikan
    public function destroy($id) {
        // Mencari produk ikan berdasarkan ID
        $produk = ProdukIkan::findOrFail($id);

        // Menghapus gambar jika ada
        if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
            unlink(public_path('storage/' . $produk->image));
        }

        // Menghapus produk dari database
        $produk->delete();

        // Mengembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil dihapus',
        ]);
    }
}
