<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;
use Session;
use App\Cart;
use DB;
use Illuminate\Support\Facades\Redirect;
use function Sodium\add;

class ProduitController extends Controller
{
    public function sauver_produit(Request $request){

       if ($request->category == 'Selectionner catégorie') {

           Session::put('message1','veuiller selectionner la catégorie');
           return redirect::to('/ajouterproduit');

       } else {

           $this->validate($request, ['product_image' => 'image|nullable|max:1999']);

           if ($request->hasFile('product_image')){

               // 1: get file name with extension
               $filenameWithExt = $request->file('product_image')->getClientOriginalName();

               // 2: get just file name
               $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

               // 3: get just the extension

               $extension =$request->file('product_image')->getClientOriginalExtension();

               // 4: file name to store
               $fileNameToStore = $filename.'_'.time().'.'.$extension;

               // 5: path
               $path =$request->file('product_image')->storeAs('public/cover_images',$fileNameToStore);
           } else {
               $fileNameToStore = 'noimage.jpg';
           }

           $data = array();
           $data['nom_produit'] = $request->name;
           $data['prix'] = $request->price;
           $data['categorie'] = $request->category;
           $data['product_image'] = $fileNameToStore; // php artisan storage:link
           $data['status'] = $request->status;

           DB::table('produits')->insert($data);

           Session::put('message','produit inséré avec succès');
           return redirect::to('/ajouterproduit');
       }


        /*
        print('vous aver ajouté le produit');
        echo '<pre></pre>';
        print("le nom de votre produit est: ".$request ->name);
        echo '<pre></pre>';
        print("le prix de votre produit est: ".$request ->price);
        echo '<pre></pre>';
        print("la catégorie de votre produit est: ".$request ->category);
        echo '<pre></pre>';
        if($request ->hasFile('product_name')){
            print("file selected");
        }else{
            print("no file selected");
        }
        echo '<pre></pre>';
        print("la status de votre produit est: ".$request ->status);
        */
    }

    public function select_by_cat($nom_produit){
        $produits = DB::table('produits')
                    ->where('categorie',$nom_produit)
                    ->get();
        $manage_produit = view('client.shop')->with('produits',$produits);
        return view('layouts.app')->with('client.shop',$manage_produit);
    }


    public function activer_produit($id){
        $data = array();
        $data['status'] = 1;

        DB::table('produits')
            ->where('id',$id)
            ->update($data);

        Session::put('message','produit activé avec succès');
        return redirect::to('/produits');
    }

    public function desactiver_produit($id){
        $data = array();
        $data['status'] = 0;

        DB::table('produits')
            ->where('id',$id)
            ->update($data);

        Session::put('message','produit désactivé avec succès');
        return redirect::to('/produits');
    }

    public function edit_produit($id){
        $produits = DB::table('produits')
            ->where('id',$id)
            ->first();

        Session::put('id',$id);

        $manage_produits = view('admin.edit_produit')
            ->with('produits',$produits);
        return view('layouts.appadmin')
            ->with('admin.edit_produit',$manage_produits);
    }

    public function modifier_produit(Request $request){
        $this->validate($request, ['product_image' => 'image|nullable|max:1999']);

        if ($request->hasFile('product_image')){

            // 1: get file name with extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();

            // 2: get just file name
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // 3: get just the extension

            $extension =$request->file('product_image')->getClientOriginalExtension();

            // 4: file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // 5: path
            $path =$request->file('product_image')->storeAs('public/cover_images',$fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $data = array();
        $data['nom_produit'] = $request->name;
        $data['prix'] = $request->price;
        $data['categorie'] = $request->category;
        //$data['product_image'] = $fileNameToStore; // php artisan storage:link

        if($request->hasFile('product_image')){
            $produits = DB::table('produits')
                        ->where('id',Session::get('id'))
                        ->first();
                $data['product_image'] = $fileNameToStore;

            if ($produits->product_image != 'noimage.jpg'){
                Storage::delete('public/cover_images'.$produits->product_image);
            }
        }

        DB::table('produits')
                ->where('id', Session::get('id'))
                ->update($data);



        Session::put('message','produit inséré avec succès');
        return redirect::to('/produits');
    }

    public function supprimer_produit($id){

        $select_image = DB::table('produits')
                        ->where('id',$id)
                        ->first();

        if ($select_image->product_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$select_image->product_image);
        }

        DB::table('produits')
            ->where('id',$id)
            ->delete();

        Session::put('message','produit supprimé avec succès');
        return redirect::to('/produits');

    }


    public function ajouter_au_panier($id){
        $produit = DB::table('produits')
                    ->where('id',$id)
                    ->first();

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->add($produit, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/');
    }

    public function ajouter_au_panier1($id){
        $produit = DB::table('produits')
            ->where('id',$id)
            ->first();

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->add($produit, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/shop');
    }

    public function panier(){
        if (!Session::has('cart')){
            return view('client.panier');
        }

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);

        return view('client.panier', ['produits' => $cart->items]);
    }

    public function modifierQty(Request $request){
        //print('qty'.$request->quantity.' id '.$request->id);

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->modiferQty($request->quantity, $request->id  );
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/panier');
    }

    public function enlever_item($id){

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->enlever_item($id);

        if (count($cart->items) > 0) {

            Session::put('cart', $cart);
        } else {
            Session::forget('cart');

        }


        //dd(Session::get('cart'));
        return redirect::to('/panier');
    }

    public function payement(){

        if(!session::has('cart')){
            return redirect::to('/panier');
        }

        return view('client.payement');
    }

    public function payer(Request $request){
        if(!Session::has('cart')){
            return redirect::to('/cart');
            // , ['Products' => null]
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51HIlOvLEdErq2YMoxJb3456QGN0YpkLDKf7zV9rAC40zYSRIYHZUjaIGmXh239Ar7qVVVQXw249mxz9oE1K3JTxG00PW8NBkWg
        ');
        try{
            Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));
        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect::to('/payement');
        }

        Session::forget('cart');
        Session::put('success', 'Achat accomplis avec succes !');
        return redirect::to('/');

    }
}
