<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\stok;
use App\Http\Requests\StorestokRequest;
use App\Http\Requests\UpdatestokRequest;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stok'] = Stok::get();
        $data['menu'] = Menu::get();
        return view('Stok.index')->with($data);
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
    public function store(StorestokRequest $request)
    {
        stok::create($request->all());
        return redirect('stok')->with('success', 'Data Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestokRequest $request, stok $stok)
    {
        $stok->update($request->all());
        return redirect('stok')->with('success', 'Data Menu berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stok $stok)
    {
        $stok->delete();
        return redirect('stok')->with('success', 'Data Menu berhasil di hapus');
    }
}
