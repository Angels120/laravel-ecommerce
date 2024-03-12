@extends('customer.layouts.app')
@section('container')
    <div class="main-content">
        <div class="page-content ">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{ $page->name ?? '' }}</h4>
                            <div class="page-title-right">
                                @if ($breadcrumb['breadcrumbs'])
                                    <ol class="breadcrumb m-0">
                                        @foreach ($breadcrumb['breadcrumbs'] as $label => $link)
                                            <li class="breadcrumb-item">
                                                @if ($label == 'current_menu')
                                                    <a>
                                                        {{ $link }}
                                                    </a>
                                                @else
                                                    <a href="{{ $link }}">
                                                        {{ $label }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="bg-soft-warning position-relative">
                                <div class="card-body p-5">
                                    <div class="text-center">
                                        <h3>{{ $page->name ?? '' }}</h3>
                                    </div>
                                </div>
                                <div class="shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                        <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                            <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                                                style="fill: var(--vz-card-bg-custom);"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1001">
                                                <rect width="1440" height="60" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mt-3 pe-lg-5">
                                        <h5>{!! $page->content ?? '' !!}</h5>
                                    </div>
                                    @if ($page->slug == 'contact-us')
                                        <div class="col-md-6 ml-2">
                                            <form method="#" id="contactForm" name="contact-form">
                                                <div class="mb-3">
                                                    <label class="mb-2" for="name">Name<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="name" type="text"
                                                        name="name">
                                                    <div class="invalid-feedback" id="NameError"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="mb-2" for="email">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="email" type="email"
                                                        name="email">
                                                    <div class="invalid-feedback" id="EmailError"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="mb-2" for="msg_subject">Subject<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" id="msg_subject" type="text"
                                                        name="subject">
                                                    <div class="invalid-feedback" id="SubjectError"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="message" class="mb-2">Message<span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="3" id="message" name="message"></textarea>
                                                    <div class="invalid-feedback" id="MessageError"></div>
                                                </div>

                                                <div class="form-submit text-center">
                                                    <button class="btn btn-primary" type="submit" id="form-submit"><i
                                                            class="ri-message-2-fill m-2"></i> Send Message</button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#contactForm').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: "{{ route('sendContactEmail') }}",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        localStorage.setItem("successMessage", response.message);
                        window.location.reload();
                        }
                },
                error: function(error) {
                    document.getElementById('NameError').style.display = "none";
                    document.getElementById('EmailError').style.display = "none";
                    document.getElementById('SubjectError').style.display = "none";
                    document.getElementById('MessageError').style.display = "none";
                    if (error.responseJSON.errors.name) {
                        var errMsg = document.getElementById('NameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.email) {
                        var errMsg = document.getElementById('EmailError');
                        if (error.responseJSON.errors.email[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.email[0];
                        }
                    }
                    if (error.responseJSON.errors.subject) {
                        var errMsg = document.getElementById('SubjectError');
                        if (error.responseJSON.errors.subject[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.subject[0];
                        }
                    }
                    if (error.responseJSON.errors.message) {
                        var errMsg = document.getElementById('MessageError');
                        if (error.responseJSON.errors.message[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.message[0];
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var errorMessage = localStorage.getItem('errorMessage');
        var successMessage = localStorage.getItem('successMessage');
        if (errorMessage) {
            showErrorToast(errorMessage);
            localStorage.removeItem('errorMessage');
        }
        if (successMessage) {
            showToast(successMessage);
            localStorage.removeItem('successMessage');
        }
    });
</script>
@endsection
