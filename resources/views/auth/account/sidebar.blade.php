
@extends('customer.layouts.app')

<style>
     .custom-nav-buttton-hover {
            font-size: 13px;
            background-color: #f3f3f9;
            padding: 10px;
            display: flex;
            justify-content: start;
            align-items: center;
            border-radius: 5px;
        }

        .custom-nav-buttton-hover:hover {
            background-color: #888c9b;
            transition: 250ms;
            color: #fff !important;
        }

        .nav-item.active {
            color: white;
            background-color: #3e4e92;
        }
</style>
@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">My Account</h4>
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
                <div class="d-md-flex justify-content-between">
                    <div class="col-md-2">
                        <div class="card">
                            <div class="container-fluid mb-3">
                                <ul class="nav" role="tablist">
                                    <li class="w-100 mb-2">
                                        <a class="custom-nav-buttton-hover my-1 nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}"
                                            href="{{ route('user.profile') }}">
                                            <i class="ri-user-fill fs-18 me-2"></i> <span class="d-md-inline-block">My Profile</span>
                                        </a>
                                    </li>
                                    <li class="w-100 mb-2">
                                        <a class="custom-nav-buttton-hover my-1 nav-item {{ request()->routeIs('user.order') ? 'active' : '' }}"
                                            href="{{ route('user.order') }}">
                                            <i class="ri-shopping-bag-fill fs-18 me-2"></i> <span class="d-md-inline-block">My order</span>
                                        </a>
                                    </li>
                                    <li class="w-100 mb-2">
                                        <a class="custom-nav-buttton-hover my-1 nav-item {{ request()->routeIs('user.wishlist') ? 'active' : '' }}"
                                            href="{{ route('user.wishlist') }}">
                                            <i class="ri-heart-fill fs-18 me-2"></i> <span class="d-md-inline-block">Wishlist</span>
                                        </a>
                                    </li>
                                    <li class="w-100 mb-2">
                                        <a class="custom-nav-buttton-hover my-1 nav-item {{ request()->routeIs('user.order') ? 'active' : '' }}"
                                            href="{{ route('user.order') }}">
                                            <i class="ri-lock-fill fs-18 me-2"></i> <span class="d-md-inline-block">Change Password</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    @yield('all-content')
                </div>
            </div><!-- end container-fluid -->

        </div>
    </div>
@endsection
