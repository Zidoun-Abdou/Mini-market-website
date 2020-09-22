@extends('layouts.appadmin')

@section('content')
<?php
    $categories = DB::table('categories')->get();
    $increment = 1;
?>



    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><h4>Categories</h4>
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
                                        <th>Nom</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $categorie)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td>{{$categorie->nom}}</td>
                                                <td>
                                                    <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_categorie/'.$categorie->id)}}">Modify</a></button>
                                                    <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimer_categorie/'.$categorie->id)}}" id="delete">Delete</a></button>
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
