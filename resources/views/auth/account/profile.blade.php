@extends('auth.account.sidebar')
@section('all-content')
    <!-- company information starts -->
    <div class="col-md-10 ms-3">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
            </div>
            <form action="" name="profileForm" id="profileForm">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $user->name }}" name="name" placeholder="Enter your Name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" value="{{ $user->email }}" name="email" placeholder="Enter your Email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" value="{{ $user->phone_number }}" name="phone_number" placeholder="Enter your phone" class="form-control">
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $("#profileForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("user.updateProfile") }}',
            type:'post',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){

            }
        });
    })
</script>
@endsection
