@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<!-- Page Content -->
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">LikeCódigo</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="row gutters-tiny">
        <!-- Earnings -->
        <div class="col-md-6 col-xl-3">
          <a class="block block-rounded block-transparent bg-gd-elegance" href="javascript:void(0)">
            <div class="block-content block-content-full block-sticky-options">
              <div class="block-options">
                <div class="block-options-item">
                  <i class="fa fa-area-chart text-white-op"></i>
                </div>
              </div>
              <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="{{ $totalMedicos }}">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Médicos</div>
              </div>
            </div>
          </a>
        </div>
        <!-- END Earnings -->

        <!-- Orders -->
        <div class="col-md-6 col-xl-3">
          <a class="block block-rounded block-transparent bg-gd-dusk" href="be_pages_ecom_orders.html">
            <div class="block-content block-content-full block-sticky-options">
              <div class="block-options">
                <div class="block-options-item">
                  <i class="fa fa-archive text-white-op"></i>
                </div>
              </div>
              <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="35">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Pacientes</div>
              </div>
            </div>
          </a>
        </div>
        <!-- END Orders -->

        <!-- New Customers -->
        <div class="col-md-6 col-xl-3">
          <a class="block block-rounded block-transparent bg-gd-sea" href="javascript:void(0)">
            <div class="block-content block-content-full block-sticky-options">
              <div class="block-options">
                <div class="block-options-item">
                  <i class="fa fa-users text-white-op"></i>
                </div>
              </div>
              <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="15">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Citas de hoy</div>
              </div>
            </div>
          </a>
        </div>
        <!-- END New Customers -->

        <!-- Conversion Rate -->
        <div class="col-md-6 col-xl-3">
          <a class="block block-rounded block-transparent bg-gd-aqua" href="javascript:void(0)">
            <div class="block-content block-content-full block-sticky-options">
              <div class="block-options">
                <div class="block-options-item">
                  <i class="fa fa-cart-arrow-down text-white-op"></i>
                </div>
              </div>
              <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 mb-0 text-white">5.6%</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Citas del mes</div>
              </div>
            </div>
          </a>
        </div>
        <!-- END Conversion Rate -->
    </div>
</div>
<!-- END Page Content -->
@endsection