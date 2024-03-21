<?php

namespace App\Http\Controllers;

use App\Models\jenis;
use App\Http\Requests\StorejenisRequest;
use App\Http\Requests\UpdatejenisRequest;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = jenis::orderBy('created_at', 'DESC')->get();
        return view('jenis.index')->with($data);
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
    public function store(StorejenisRequest $request)
    {
        jenis::create($request->all());
        return redirect('jenis')->with('success', 'Data Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejenisRequest $request, jenis $jeni)
    {
        $jeni->update($request->all());
        return redirect('jenis')->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis $jeni)
    {
        $jeni->delete();
        return redirect('jenis')->with('success', 'Data Berhasil di hapus');
    }
}
