<?php

namespace App\Http\Controllers\Api;

use App\Models\ProdukIkan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukIkanController extends Controller
{
    public function index() {
        return response()->json(ProdukIkan::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk_ikan', 'public');
        }

        $produk = ProdukIkan::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil ditambahkan',
            'data' => $produk,
        ]);
    }

    public function show($id) {
        $produk = ProdukIkan::findOrFail($id);
        $produk->image = url('storage/' . $produk->image);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
    
        $produk = ProdukIkan::findOrFail($id);
    
        
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        
        if ($request->hasFile('image')) {
            if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
                unlink(public_path('storage/' . $produk->image));
            }
            $data['image'] = $request->file('image')->store('produk_ikan', 'public');
        }
    
     
        $produk->update([
            'nama' => $data['nama'],
            'harga' => $data['harga'],
            'image' => $data['image'] ?? $produk->image, 
        ]);
    
        
        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil diperbarui',
            'data' => $produk,
        ]);
    }
    
    public function destroy($id) {
        $produk = ProdukIkan::findOrFail($id);

        
        if ($produk->image && file_exists(public_path('storage/' . $produk->image))) {
            unlink(public_path('storage/' . $produk->image));
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk ikan berhasil dihapus',
        ]);
    }
}
