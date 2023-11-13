@extends('admin.layouts.app')
@section('container')
<h1 class="mb10">Manage Size</h1>
<a href="{{ route('admin.sizes.index') }}">
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
                            <form action="{{route('admin.sizes.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <input id="size" name="size" type="text" class="form-control" >
                                    @error('size')
                                    <div class="alert alert-danger" >{{ $message }}</div>
                                  @enderror
                                </div>
                                <label for="status">Stauts</label>
                                <br>
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault1" type="radio"
                                            name="status" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault2" type="radio"
                                            name="status" checked="" value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">Unavailable</label>
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

