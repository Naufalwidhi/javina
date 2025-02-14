<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    //Index
    public function home()
    {

        // return $id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
        ])->get('http://anggrek.herokuapp.com/api/product');

        $banner = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
        ])->get('http://anggrek.herokuapp.com/api/product/1',[
            'id' => '1'
        ]);

        $bunga = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
        ])->get('http://anggrek.herokuapp.com/api/catalog/product', [
            'id_catalog' => '1'
        ]);
        $bahan = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
        ])->get('http://anggrek.herokuapp.com/api/catalog/product', [
            'id_catalog' => '1'
        ]);

        $product = $response['product'];
        $banner = $banner['product'];

        $bunga = $bunga['product'];
        $bahan = $bahan['product'];

        return view('user/home', compact('product','bunga','bahan','banner'));
    }

    public function catalog()
    {
        $val = session()->get("coba");

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Requsted-With' => 'XML/HttpRequest',
            'Authorization' => "Bearer " . $val
        ])->get('http://anggrek.herokuapp.com/api/catalogs');

        return $response;
    }
}
