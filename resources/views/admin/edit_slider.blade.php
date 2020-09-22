@extends('layouts.appadmin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit slider</h4>
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
                            {!! Form::open(['action' => 'SliderController@modifier_slider','method'=>'POST','class'=>'form-horizontal', "enctype"=> 'multipart/form-data']) !!}                                <fieldset>
                                <div class="form-group">
                                    <label for="cname">Description one</label>
                                    <input id="cname" class="form-control" name="description1" minlength="2" value="{{$sliders->description1}}" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="cname">Description two</label>
                                    <input id="cname" class="form-control" name="description2" minlength="2" value="{{$sliders->description2}}" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="cname">Image</label>
                                    {{Form::file('slider_image' ,['id'=>'cname' ,'class'=>'form-control'])}}
                                    {{--<input id="cname" class="form-control" name="name" minlength="2" type="file" required>--}}
                                </div>
                                <input class="btn btn-primary" type="submit" value="Edit slider">
                            </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
@endsection
