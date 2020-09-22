@extends('layouts.app')

@section('title')
    panier
@endsection
@section('content')


<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                {!! Form::open(['action' => 'ProduitController@payer','method'=>'POST','class'=>'form-horizontal', 'id'=>'checkout-form', "enctype"=> 'multipart/form-data']) !!}
                <fieldset>
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <?php
                    $error = Session::get('error'); // bah djib la valeur de msg li rah f controlleur
                    ?>
                    @if($error)  {{-- si le msg rah kayen --}}
                    <p class="alert alert-success">
                        <?php
                        echo $error; // afficher le msg
                        Session::put('error', null); // anuller le msg
                        ?>
                    </p>
                    @endif
                    <h3 class="mb-4 billing-heading">${{Session::get('cart')->totalPrice}}</h3>

                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Noms</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">Adresse</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">Nom sur la carte</label>
                                <input type="text" class="form-control" placeholder="" id="card-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Numéro de la carte</label>
                                <input type="text" class="form-control" placeholder="" id="carte-number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Mois d'expiration</label>
                                <input type="text" class="form-control" placeholder="" id="card-expery-mounth">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Année d'expiration</label>
                                <input type="text" class="form-control" placeholder="" id="card-expery-year">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">CVC</label>
                                <input type="text" class="form-control" placeholder="" id="card-cvc">
                            </div>
                        </div>

                    </div>
                    <input class="btn btn-success" type="submit" value="Ajouter produit">
                </fieldset>
            {!! Form::close() !!}                    <!-- END -->
            </div> </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                <span>Get e-mail updates about our latest shops and special offers</span>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control" placeholder="Enter email address">
                        <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts1')
<script>
    $(document).ready(function(){

        var quantitiy=0;
        $('.quantity-right-plus').click(function(e){

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if(quantity>0){
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>
@endsection

@section('script')
    <script src="https://js.stripe.com/v2/"></script>
    <script src="src/js/payement.js"></script>
@endsection
