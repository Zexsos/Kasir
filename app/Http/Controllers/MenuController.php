<?php

namespace App\Http\Controllers;

use App\Models\jenis;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = jenis::get();
        $data['menu'] = menu::orderBy('created_at', 'DESC')->get();
        return view('menu.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $image = $request->file('image');

        $filename = date('Y-m-d') . $image->getClientOriginalName();

        $path = 'images/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($image));

        $data['jenis_id'] = $request->jenis_id;
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['jumlah'] = $request->jumlah;
        $data['image'] = $filename;
        Menu::create($data);
        return redirect('menu')->with('success', 'Data menu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        if ($request->file('image')) {
            if ($request->old_image) {
                Storage::disk('public')->delete('images/' . $request->old_image);
            }
            $image = $request->file('image');
            $filename = date('Y-m-d') . $image->getClientOriginalName();
            $path = 'images/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));
            $data['image'] = $filename;
        }

        $data['jenis_id'] = $request->jenis_id;
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['jumlah'] = $request->jumlah;
        $data['image'] = $filename;
        $menu->update($data);
        return redirect('menu')->with('success', 'Data menu berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete('images/' . $menu->image);
        }
        $menu->delete();
        return redirect('menu')->with('success', 'Data Berhasil di hapus');
    }
}
