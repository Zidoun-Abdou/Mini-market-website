@extends('layouts.appadmin')

@section('content')
    <?php
    $produits = DB::table('produits')->get();
    $increment = 1;
    ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><h4>Products</h4>
                        <?php
                        $message = Session::get('message'); // bah djib la valeur de msg li rah f controlleur
                        $message1 = Session::get('message1');
                        ?>
                        @if($message)  {{-- si le msg rah kayen --}}
                        <p class="alert alert-success">
                            <?php
                            echo $message; // afficher le msg
                            Session::put('message', null); // anuller le msg
                            ?>
                        </p>
                        @endif
                        @if($message1)  {{-- si le msg rah kayen --}}
                        <p class="alert alert-danger">
                            <?php
                            echo $message1; // afficher le msg
                            Session::put('message1', null); // anuller le msg
                            ?>
                        </p>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Image</th>
                                            <th>Nmae</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($produits as $produit)
                                        <tr>
                                            <td>{{$increment}}</td>
                                            <td><img src="storage/cover_images/{{$produit->product_image}}" alt=""></td>
                                            <td>{{$produit->nom_produit}}</td>
                                            <td>{{$produit->prix}}.$</td>
                                            <td>{{$produit->categorie}}</td>
                                            @if ($produit->status == 1)
                                                <td>
                                                    <label class="badge badge-success">Enable</label>
                                                </td>
                                            @else
                                                <td>
                                                    <label class="badge badge-danger">Desable</label>
                                                </td>
                                            @endif
                                            <td>
                                                <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_produit/'.$produit->id)}}">Modify</a></button>
                                                <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimer_produit/'.$produit->id)}}" id="delete">Delete</a></button>
                                                @if ($produit->status == 1)
                                                    <button class="btn btn-outline-warning"><a href="{{URL::to('/desactiver_produit/'.$produit->id)}}">Enable</a></button>
                                                @else
                                                    <button class="btn btn-outline-success"><a href="{{URL::to('/activer_produit/'.$produit->id)}}">Desable</a></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php
                                        $increment = $increment + 1;
                                        ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
@endsection
