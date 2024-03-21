<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\produktitipanExport;
use App\Models\produk_titipan;
use App\Http\Requests\Storeproduk_titipanRequest;
use App\Http\Requests\Updateproduk_titipanRequest;

class ProdukTitipanController extends Controller
{
    public function export()
    {
        return Excel::download(new ProdukTitipanExport, 'produk_titipan.xlsx');
    }

    public function index()
    {
        $data['produktitipan'] = produk_titipan::orderBy('created_at', 'DESC')->get();
        return view('produktitipan.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeproduk_titipanRequest $request)
    {
        produk_titipan::create($request->all());
        return redirect('produktitipan')->with('success', 'Data Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateproduk_titipanRequest $request, produk_titipan $produk_titipan, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'nama_supplier' => 'required|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $produk = produk_titipan::findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->nama_supplier = $request->nama_supplier;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;
        $produk->keterangan = $request->keterangan;
        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');

        $validated = $request->validate([
            'stok' => 'required|numeric|min:0',
        ]);

        $produkTitipan = produk_titipan::findOrFail($id);
        $produkTitipan->stok = $validated['stok'];
        $produkTitipan->save();

        return response()->json(['message' => 'Stock updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk_titipan $produk_titipa, $id)
    {
        $produk_titipan = produk_titipan::findOrFail($id);
        $produk_titipan->delete();

        return redirect('produktitipan')->with('success', 'Data berhasil dihapus');
    }
}
