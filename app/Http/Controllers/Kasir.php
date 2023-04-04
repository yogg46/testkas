<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\penjualan;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kasir extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = barang::all();

        return view('index', ['barang' => $barang]);
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
    public function store(Request $request)
    {
        $items = $request->input('items');
        $total = 0;
        $transaction = new transaksi();
        $transaction->total = $total;
        $transaction->catatan = $request->input('catatan'); // retrieve the catatan field from the request object
        $transaction->save();

        foreach ($items as $id => $quantity) {
            $price = Barang::where('id', $id)->value('price');
            $subtotal = $price * $quantity;
            $total += $subtotal;

            $penjualan = new Penjualan();
            $penjualan->barang_id = $id;
            // $penjualan->barang_id = $id;
            $penjualan->transaksi_id = $transaction->id;
            $penjualan->qty = $quantity;
            $penjualan->total = $subtotal;

            $penjualan->save();
        }

        $jumlah = Penjualan::where('transaksi_id', $transaction->id)->sum('total');
        $transaction->update(['total' => $jumlah]);


        Penjualan::where('qty', 0)->delete();
        // Save the total value to your database or perform other actions...
        // For example:
        // $transaction = new Transaction();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
