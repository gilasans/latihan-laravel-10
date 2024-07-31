<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class BelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    public function enkripsi(Request $request)
    {
        $string = "Saya suka makan sate padang";
        $enkripsi = Crypt::encryptString($string);
        $deskripsi = Crypt::decryptString($enkripsi);

        echo "string :" . $string. "<br><br>" ;
        echo "Hasil Enkripsi : " . $enkripsi . "<br><br>";
        echo "Deskripsi : " . $deskripsi;

        $params = [
            'nama' =>'Saefulloh ',
            'Hobby' => 'Mendengarkan Music',
            'umur' => 22,
        ];

        $params = Crypt::encrypt($params);
        echo "<a href= ". route('enkripsi-detail', ['params' => $params]) .">Lihat detail disini</a>";
    }

    public function enkripsi_detail(Request $request ,$params){

        $params = Crypt::decrypt($params);
        dd($params);
    }

    public function hashing()
    {
        $string = "Saefulloh123!";
        $hash = Hash::make($string);

        echo "string " . $string . "<br><br>";
        echo "Hasil Hashing " .$hash . "<br><br>";
        echo "<hr>";

        $string2 = "Saefulloh123!";
        $hash2 = Hash::make($string2);

        echo "string 2 " . $string2 . "<br><br>";
        echo "Hasil Hashing 2" .$hash2 . "<br><br>";

        $pengecekan = Hash::check($string2, $hash);
        echo "<br>";
        if ($pengecekan) {
            echo "Password Benar";
        } else {
            echo "Password Salah";
        }

    }
}
