<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function getTransaction()
    {
        $query = "select a.id, b.name, c.nama_produk, a.kuantitas, a.total_harga, a.created_at from transactions a, users b, products c where a.id_produk = c.id and a.id_user = b.id";
        $data = DB::connection('mysql')->select($query);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function insertTransaction()
    {
        $kuantitas  = 2;
        $produk     = 5;
        $user       = 1;
        $item = DB::connection('mysql')->select("select * from products where id = '$produk'");
        $user = DB::connection('mysql')->select("select * from users where id = '$user'");

        if (!empty($item) && !empty($user)) {
            $item = $item[0];
            $user = $user[0];
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk atau pengguna tidak ditemukan'
            ]);
        }

        $query  = "insert into transactions values (id, :idproduct, :iduser, :kuantitas, :total, :created_at, :updated_at)";
        $exec   = DB::connection('mysql')->insert($query, [
            'idproduct' => $item->id,
            'iduser' => $user->id,
            'kuantitas' => $kuantitas,
            'total' => $item->harga * $kuantitas,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($exec) {
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ]);
    }
}