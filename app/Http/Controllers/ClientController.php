<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    //

    public function home(){

      return view('client.home');
    }

    public function shop(){
        $produits = DB::table('produits')
            ->where('status',1)
            ->get();
        $manage_produit = view('client.shop')->with('produits',$produits);
        return view('layouts.app')->with('client.shop',$manage_produit);
    }

   /* public function panier(){

        return view('client.panier');
    } */

//    public function payement(){
//
//        return view('client.payement');
//    }

}
