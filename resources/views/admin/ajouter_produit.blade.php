@extends('layouts.appadmin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add product</h4>
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
                            {{--<form class="cmxform" id="commentForm" method="get" action="#">--}}
                                {!! Form::open(['action' => 'ProduitController@sauver_produit','method'=>'POST','class'=>'form-horizontal', "enctype"=> 'multipart/form-data']) !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="cname">Name</label>
                                            <input id="cname" class="form-control" name="name" minlength="2" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Price</label>
                                            <input id="cname" class="form-control" name="price" minlength="2" type="number" required>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                $categories = DB::table('categories')
                                                    ->get();
                                            ?>
                                            <label for="cname">Category</label>
                                            <select id="sortingField" class="form-control" name="category">
                                                <option >Selectionner catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option >{{ $categorie->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="image_pro">Image</label>
                                            {{Form::file('product_image' ,['id'=>'image_pro' ,'class'=>'form-control'])}}
                                            {{-- <input id="cname" class="form-control" name="name" minlength="2" type="file" required> --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="cname">Status</label>
                                            <input  type="checkbox" name="status" value="1" required>
                                        </div>

                                        <input class="btn btn-primary" type="submit" value="Add product">
                                    </fieldset>
                                {!! Form::close() !!}
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
@endsection
