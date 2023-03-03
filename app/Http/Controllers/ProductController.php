<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProduct()
    {
        $query = "select * from products";
        $data = DB::connection('mysql')->select($query);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function insertProduct()
    {
        $query = "insert into products values (id, :nama, :deskripsi, :harga, :created_at, :updated_at)";
        $exec  = DB::connection('mysql')->insert($query, [
            'nama' => 'Xiaomi Redmi 4',
            'deskripsi' => 'lorem ddddipsum dolor sit amet adipis',
            'harga' => 4230000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($exec) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil disimpan'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ]);
    }
}