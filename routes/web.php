<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/','ClientController@home');
Route::get('/shop','ClientController@shop');
//Route::get('/panier','ClientController@panier');
//Route::get('/payement','ClientController@payement');

Route::get('/admin','AdminController@admin');
Route::get('/ajoutercategorie','AdminController@ajoutercategorie');
Route::get('/ajouterproduit','AdminController@ajouterproduit');
Route::get('/ajouterslider','AdminController@ajouterslider');
Route::get('/categories','AdminController@categories');
Route::get('/produits','AdminController@produits');
Route::get('/sliders','AdminController@sliders');

Route::post('/sauver_produit','ProduitController@sauver_produit');

Route::post('/sauver_category','CategoryController@sauver_category');
Route::get('/edit_categorie/{id}','CategoryController@edit_categorie');
Route::post('/modifier_categorie','CategoryController@modifier_categorie');
Route::get('/supprimer_categorie/{id}','CategoryController@supprimer_categorie');


Route::post('/sauver_slider','SliderController@sauver_slider');
Route::get('/activer_slider/{id}','SliderController@activer_slider');
Route::get('/desactiver_slider/{id}','SliderController@desactiver_slider');
Route::get('/edit_slider/{id}', 'SliderController@edit_slider');
Route::post('/modifier_slider','SliderController@modifier_slider');
Route::get('/supprimer_slider/{id}', 'SliderController@supprimer_slider');



Route::get('/select_by_cat/{nom_produit}','ProduitController@select_by_cat');
Route::get('/activer_produit/{id}','ProduitController@activer_produit');
Route::get('/desactiver_produit/{id}','ProduitController@desactiver_produit');
Route::get('/edit_produit/{id}','ProduitController@edit_produit');
Route::post('modifier_produit','ProduitController@modifier_produit');
Route::get('/supprimer_produit/{id}','ProduitController@supprimer_produit');
Route::get('/ajouter_au_panier/{id}','ProduitController@ajouter_au_panier');
Route::get('/ajouter_au_panier1/{id}','ProduitController@ajouter_au_panier1');
Route::get('/panier','ProduitController@panier');
Route::post('/modifierQty','ProduitController@modifierQty');
Route::get('/enlever_item/{id}', 'produitController@enlever_item');
Route::get('/payement','produitController@payement');
Route::post('payer','ProduitController@payer');




