<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi;
use App\Models\Jenis;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $menu = Menu::all();
        $jenis = Jenis::all();
        return view('transaksi.index', compact('menu', 'jenis', 'pelanggan'));
    }

    public function faktur($nofaktur)
    {
        // try {
        //     // $data['transaksi'] = Transaksi::where('id', $nofaktur)->with(['detail_transaksi' => function ($query) {
        //     //     $query->with('menu');
        //     // }])->first();


        $transaksi = Transaksi::findOrFail($nofaktur);
        return view('faktur.index', compact('transaksi'));
        // } catch (Exception | QueryException | PDOException $e) {
        //     return response()->json(['status' => false, 'message' => 'Transaksi gagal']);
        // }
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
    public function store(StoretransaksiRequest $request)
    {
        try {
            DB::beginTransaction();
            $last_id = Transaksi::where('tanggal', date('y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();

            $notrans = $last_id !== null ? date('ymd') . sprintf('%04d', substr($last_id->id, 8, 4) + 1) : date('ymd') . '0001';


            $inserttransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash',
                'keterangan' => 'Transaksi berhasil',
                'id_pelanggan' => $request->pelanggan
            ]);



            if (!$inserttransaksi) return 'error';

            foreach ($request->orderedList as $detail) {
                $insertdetail_transaksi = detail_transaksi::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Transaksi berhasil',
                'notrans' => $notrans,
            ]);
        } catch (Exception | QueryException | PDOException $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Transaksi gagal', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
