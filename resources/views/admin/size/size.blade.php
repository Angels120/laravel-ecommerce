@extends('admin.layouts.app')

@section('container')
<h1 class="mb10">sizes</h1>
  <a href="{{ route('admin.sizes.create') }}">
    <button type="button" class="btn btn-success">
        Add size
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
                            <th>Size</th>
                            <th>Status</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                        <tr>
                            <td>{{$size->id }}</td>
                            <td>{{$size->size}}</td>
                            <td>
                            <div style="display: inline-block; margin-right: 10px;">
                                <div style="display: inline-block; margin-right: 10px;">
                                    @if($size->status == 1)
                                    <button type="submit" class="btn btn-success">Available</button></a>
                                    @elseif ($size->status==0)
                                    <button type="submit" class="btn btn-danger">Unavailable</button>
                                    @endif
                                </div>
                            </td>
                            <td class="center-button">
                                <div style="display: inline-block; margin-right: 10px;">
                                    <a href="sizes/{{ $size->id }}/edit"
                                        class="btn btn-success" >edit</a>
                                </div>
                                <form action="{{ route('admin.sizes.destroy', $size->id) }}"
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
