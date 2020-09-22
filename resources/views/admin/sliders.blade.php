@extends('layouts.appadmin')

@section('content')
    <?php
    $sliders = DB::table('sliders')->get();
    $increment = 1;
    ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><h4>Sliders</h4>
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
                                            <th>Description one</th>
                                            <th>Description two</th>
                                            <th>Catégorie</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sliders as $slider)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td><img src="storage/slider_images/{{$slider->slider_image}}" alt=""></td>
                                                <td>{{$slider->description1}}</td>
                                                <td>{{$slider->description2}}</td>
                                                @if ($slider->status == 1)
                                                    <td>
                                                        <label class="badge badge-success">Enable</label>
                                                    </td>
                                                @else
                                                    <td>
                                                        <label class="badge badge-danger">Desable</label>
                                                    </td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-outline-primary"><a href="{{URL::to('/edit_slider/'.$slider->id)}}">Modify</a></button>
                                                    <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimer_slider/'.$slider->id)}}" id="delete">Delete</a></button>
                                                    @if ($slider->status == 1)
                                                        <button class="btn btn-outline-warning"><a href="{{URL::to('/desactiver_slider/'.$slider->id)}}">Desable</a></button>
                                                    @else
                                                        <button class="btn btn-outline-success"><a href="{{URL::to('/activer_slider/'.$slider->id)}}">Enable</a></button>
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
