@extends('admin.layouts.app')
@section('container')
<h1 class="mb10">Edit size</h1>
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
                            <form action="{{ route('admin.sizes.update', $size->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <input id="size" name="size" type="text" class="form-control"
                                        value="{{ old('size') ?? $size->size }}">
                                    @error('size')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="is_active">Status</label>
                                <br>
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="status"
                                            value="1" @if ($size->status) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault2" type="radio" name="status"
                                            value="0" @if (!$size->status) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault2">Unavailable</label>
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

