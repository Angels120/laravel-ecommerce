@extends('admin.layouts.app')
@section('container')
<h1 class="mb10">Edit coupon</h1>
<a href="{{ route('admin.coupons.index') }}">
    <button type="button" class="btn btn-success">
        Back
    </button>
   </a>
    <div class="row m-t-30">
        <div class="col-md-12">
         <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="coupon_name" class="control-label mb-1">coupon Title</label>
                                    <input id="coupon_name" name="title" type="text" class="form-control"
                                        value="{{ old('title') ?? $coupon->title }}">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="coupon_code" class="control-label mb-1">coupon Code</label>
                                    <input id="coupon_code" name="code" type="text" class="form-control"
                                        value="{{ old('code') ?? $coupon->code }}">
                                    @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="coupon_value" class="control-label mb-1">value</label>
                                    <input id="coupon_value" name="value" type="text" class="form-control"
                                        value="{{ old('value') ?? $coupon->value }}">
                                    @error('value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>



            <!-- END DATA TABLE-->
        </div>
    </div>
</div>

@endsection

