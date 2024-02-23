@extends('admin_dashboard')
@section('admin')
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a class="btn btn-primary rounded-pill waves-effect waves-light"
                                href="{{ route('all.product') }}">Back</a>

                        </div>
                        <h4 class="page-title">Bar Code Product</h4>
                    </div>
                </div>

            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form id="myForm" method="POST" action="{{ route('product.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Bar Code Product</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="product_code" class="form-label">Product Code </label>
                                                <h3>{{ $product->product_code }}</h3>

                                            </div>
                                        </div>

                                        @php
                                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="product_store" class="form-label">Product Bar Code </label>
                                                <h3>{!! $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128) !!}</h3>

                                            </div>
                                        </div>

                                    </div> <!-- end row -->


                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
