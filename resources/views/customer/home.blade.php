@extends('customer.layouts.app')

@section('container')
<style>
    .img_div img {
        /* object-fit: cover; */
        width: 100%;
        /* height: 800px; */
    }

    .card {
        cursor: pointer;
        transition: 0.3s;
        padding: 10px;
    }

    .card:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>

<div class="img_div">
    <img src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="">
</div>


<div class="container mt-5 mb-5">
    <div class="row border border-primary d-flex align-items-center">
        <div class="col-sm-6 col-xl-3">
            <!-- Simple card -->
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-2">Web Developer</h4>
                    <p class="card-text">Price</p>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-sm-6 col-xl-3">
            <!-- Simple card -->
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-2">Web Developer</h4>
                    <p class="card-text">Price</p>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-sm-6 col-xl-3">
            <!-- Simple card -->
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-2">Web Developer</h4>
                    <p class="card-text">Price</p>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-sm-6 col-xl-3">
            <!-- Simple card -->
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-2">Web Developer</h4>
                    <p class="card-text">Price</p>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->

        <!-- <h1>This is home</h1>
            <h1>This is home</h1>
            <h1>This is home</h1>
            <h1>This is home</h1>
            <h1>This is home</h1>
            <h1>This is home</h1> -->
        <!-- Add more content here to exceed the width -->
    </div>
</div>

@endsection