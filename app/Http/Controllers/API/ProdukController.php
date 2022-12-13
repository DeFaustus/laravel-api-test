<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'code'  => 200,
            'status' => true,
            'data' => Produk::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'kode_produk'     => 'required',
            'nama_produk'  => 'required',
            'harga'  => 'required'
        ]);
        $data = $validate->validated();
        Produk::create($data);
        return response()->json([
            'code'  => 200,
            'status' => true,
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return response()->json([
            'code'  => 200,
            'status' => true,
            'data' => $produk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $validate = Validator::make($request->all(), [
            'kode_produk'     => 'required',
            'nama_produk'  => 'required',
            'harga'  => 'required'
        ]);
        $data = $validate->validated();
        $produk->update($data);
        return response()->json([
            'code'  => 200,
            'status' => true,
            'data' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json([
            'code'  => 200,
            'status' => true,
            'data' => true
        ]);
    }
}
