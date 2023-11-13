@extends('admin.layouts.app')

@section('container')
<h1 class="mb10">Coupons</h1>
  <a href="{{ route('admin.coupons.create') }}">
    <button type="button" class="btn btn-success">
        Add Coupon
    </button>
   </a>
   @if ($message = Session::get('success'))
   <div class="alert alert-success">
       <p>{{ $message }}</p>
   </div>
@endif
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{$coupon->id }}</td>
                            <td>{{$coupon->title}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->value}}</td>
                            <td class="center-button">
                                <div style="display: inline-block; margin-right: 10px;">
                                    <a href="coupons/{{ $coupon->id }}/edit"
                                        class="btn btn-success" >edit</a>
                                </div>

                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                    method="POST" style="display: inline-block; margin-left: 10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" value="DELETE"
                                        class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
