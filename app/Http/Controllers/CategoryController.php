<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\redirect;

class CategoryController extends Controller
{
    public function sauver_category(Request $request){
        $data = array(); // dirha bah dakhel f tableau
        $data['nom'] = $request->name; // hna dir dir les information ta3 html

        DB::table('categories')->insert($data); // hna dir la table li dakhel biha
        Session::put('message', 'Categorie ajoutée avec succès '); // message a afficher lazem diro aussi f partie html

        return redirect::to('/ajoutercategorie'); // hna bah twelli l akch page
    }

    public function edit_categorie($id){
        $categories = DB::table('categories')
                    ->where('id',$id)
                    ->first();
        $manage_categories = view('admin.edit_categorie')
                            ->with('categories',$categories);
        return view('layouts.appadmin')
            ->with('admin.edit_categorie',$manage_categories);
    }

    public function modifier_categorie(Request $request){

        $data = array();
        $data['nom'] = $request->name;

        $data1 = array();
        $data1['categorie'] = $request->name;

        $ancien_cat = DB::table('categories')
                    ->where('id',$request->id)
                    ->first();

        DB::table('produits')
            ->where('categorie',$ancien_cat->nom)
            ->update($data1);

        DB::table('categories')
            ->where('id',$request->id)
            ->update($data);


        Session::put('message', 'Categorie modifié avec succès '); // message a afficher lazem diro aussi f partie html

        return redirect::to('/categories'); // hna bah twelli l kach page

    }

    public function supprimer_categorie($id){

        DB::table('categories')
            ->where('id',$id)
            ->delete();

        Session::put('message', 'Categorie supprimé avec succès '); // message a afficher lazem diro aussi f partie html

        return redirect::to('/categories'); // hna bah twelli l kach page

    }
}
