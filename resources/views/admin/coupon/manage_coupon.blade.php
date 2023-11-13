@extends('admin.layouts.app')
@section('container')
<h1 class="mb10">Manage coupon</h1>
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
                            <form action="{{route('admin.coupons.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="coupon_title" class="control-label mb-1">Title</label>
                                    <input id="coupon_title" name="title" type="text" class="form-control" value="{{old('title')}}" >
                                    @error('title')
                                    <div class="alert alert-danger" >{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="form-group">
                                    <label for="coupon_code" class="control-label mb-1">Code</label>
                                    <input id="coupon_code" name="code" type="text" class="form-control" value="{{old('code')}}" >
                                    @error('code')
                                    <div class="alert alert-danger" >{{ $message }}</div>
                                  @enderror
                                </div>

                                <div class="form-group">
                                    <label for="coupon_value" class="control-label mb-1">Value</label>
                                    <input id="coupon_value" name="value" type="text" class="form-control" value="{{old('value')}}">
                                    @error('value')
                                    <div class="alert alert-danger" >{{ $message }}</div>
                                @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- END DATA TABLE-->
        </div>
    </div>
</div>

@endsection

