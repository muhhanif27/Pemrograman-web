<?php


namespace App\Http\Controllers\Api;

use App\Models\ProdukAquarium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukAquariumController extends Controller
{
    public function index() {
        return response()->json(ProdukAquarium::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk_aquarium', 'public');
        }

        $produk = ProdukAquarium::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Produk aquarium berhasil ditambahkan',
            'data' => $produk,
        ]);
    }

    public function show($id) {
        $produk = ProdukAquarium::findOrFail($id);
        $produk->image = url('storage/' . $produk->image);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        // Cari produk
        $produk = ProdukAquarium::findOrFail($id);

        // Jika ada file gambar, proses upload
        if ($request->hasFile('image')) {
            if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
                unlink(public_path('storage/' . $produk->image));
            }
            $data['image'] = $request->file('image')->store('produk_aquarium', 'public');
        }

        // Update produk
        $produk->update($data);

        // Berikan respons
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk,
        ]);
    }

    public function destroy($id) {
        $produk = ProdukAquarium::findOrFail($id);

        if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
            unlink(public_path('storage/' . $produk->image));
        }

        $produk->delete();

        return response()->json(['message' => 'Produk aquarium berhasil dihapus']);
    }
}
