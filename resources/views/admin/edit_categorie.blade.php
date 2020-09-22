@extends('layouts.appadmin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit category</h4>
                            <?php
                            $message = Session::get('message'); // bah djib la valeur de msg li rah f controlleur
                            ?>
                            @if($message)  {{-- si le msg rah kayen --}}
                            <p class="alert alert-success">
                                <?php
                                echo $message; // afficher le msg
                                Session::put('message', null); // anuller le msg
                                ?>
                            </p>
                            @endif
                            {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                            {!! Form::open(['action' => 'CategoryController@modifier_categorie','method'=>'POST','class'=>'form-horizontal', "enctype"=> 'multipart/form-data']) !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="cname">Catégorie</label>
                                    <input id="cname" class="form-control" name="name" minlength="2" type="text" value="{{$categories->nom}}" required>
                                    <input id="cname" class="form-control" name="id" minlength="2" type="hidden" value="{{$categories->id}}" required>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Edit category">
                            </fieldset>
                            {!! Form::close() !!}
                            {{--  </form> --}}
                        </div>
                    </div>
                </div>
            </div>
@endsection
