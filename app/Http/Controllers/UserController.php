<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUser()
    {
        $query = "select * from users";
        $data = DB::connection('mysql')->select($query);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function insertUser()
    {
        $query = "insert into users values (id, :name, :email, null, :password, null, :created_at, :updated_at)";
        $exec  = DB::connection('mysql')->insert($query, [
            'name' => 'bambang',
            'email' => 'bambang_2832@gmail.com',
            'password' => Hash::make('wkwkwkkwkw'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($exec) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan user'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ]);
    }
}