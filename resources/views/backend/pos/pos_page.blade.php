@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">POS System</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">POS</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>SubTotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $allcart = Cart::content();
                                    @endphp
                                    <tbody>
                                        @foreach ($allcart as $cart)
                                            <tr>
                                                <td>{{ $cart->name }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <form action="{{ url('/cart-update/' . $cart->rowId) }}" method="POST"
                                                        style="display: flex;">
                                                        @csrf
                                                        <input class="form-control" value="{{ $cart->qty }}"
                                                            min="1" id="qty"
                                                            style="width: 60px; padding: 0px;margin-right: 5px;"
                                                            type="number" name="qty">
                                                        <button type="submit" class="btn btn-sm btn-success "><i
                                                                class="fa fa-check"></i></button>
                                                    </form>
                                                </td>
                                                <td>{{ $cart->price }}</td>
                                                <td>{{ $cart->price * $cart->qty }}</td>
                                                <td>
                                                    <a href="{{ url('/delete-cart/' . $cart->rowId) }}"><i
                                                            class="fa fa-trash" style="color: red"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-primary">
                                <br>
                                <p class="text-white h3 ">Quantity: {{ Cart::count() }}</p>
                                <p class="text-white h3 ">Subtotal: {{ Cart::subtotal() }}</p>
                                <p class="text-white h3 ">Vat: {{ Cart::tax() }}</p>
                                <p>
                                <h2 class="text-white">Total:</h2>
                                <h1 class="text-white">{{ Cart::total() }}</h1>
                                </p>
                                <br>
                            </div>

                            <form id="myForm" action="{{ url('/create-invoice') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3 mt-2">
                                    <label for="customer_id" class="form-label">All Customer</label>
                                    &nbsp;&nbsp;
                                    <a href="{{ route('add.customer') }}"
                                        class="btn btn-primary rounded-pill waves-effect waves-light mb-1"><i
                                            class="fa fa-plus"></i> </a>
                                    <select name="customer_id" class="form-control">
                                        <option value="" selected disabled>Select customer</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <button class="btn btn-blue waves-effect waves-light">Create Invoice</button>

                            </form>
                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col-->

                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>


                                        @foreach ($product as $key => $item)
                                            <tr>
                                                <form action="{{ url('/add-cart') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->product_name }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="price"
                                                        value="{{ $item->selling_price }}">

                                                    <td>{{ $key + 1 }}</td>
                                                    <td><img src="{{ asset($item->product_image) }}"
                                                            style="width: 50px;height: 40px;">
                                                    </td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>
                                                        <button class="btn btn-success waves-effect waves-light"
                                                            type="submit"><i class="mdi mdi-plus"></i></button>
                                                    </td>
                                                </form>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- end settings content-->

                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->


    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    customer_id: {
                        required: true,
                    },
                },
                messages: {
                    customer_id: {
                        required: 'Please Select Customer',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
