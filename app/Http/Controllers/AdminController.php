<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function admin(){
        return view('admin.dashboard');
    }

    public function ajoutercategorie(){
        return view('admin.ajouter_categorie');
    }

    public function ajouterproduit(){
        return view('admin.ajouter_produit');
    }

    public function ajouterslider(){
        return view('admin.ajouter_slider');
    }

    public function categories(){
        return view('admin.categories');
    }

    public function produits(){
        return view('admin.produits');
    }

    public function sliders(){
        return view('admin.sliders');
    }
}
