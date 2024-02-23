@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title text-center">Edit Product</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane" id="settings">

                                <form action="{{ route('update.product', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="product_name" value="{{ $product->product_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="exampleInputEmail1">Category Name</label>
                                                <select class="form-control" name="category_id">
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == $product->category_id) selected @endif>
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Supplier Name</label>
                                                <select class="form-control" name="supplier_id">
                                                    @foreach ($supplier as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == $product->supplier_id) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Product Code</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="product_code" value="{{ $product->product_code }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Product Garage</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="product_garage" value="{{ $product->product_garage }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Product Store</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="product_store" value="{{ $product->product_store }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Buying Date</label>
                                                <input type="date" class="form-control" id="exampleInputEmail1"
                                                    name="buying_date" value="{{ $product->buying_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Expire Date</label>
                                                <input type="date" class="form-control" id="exampleInputEmail1"
                                                    name="expire_date" value="{{ $product->expire_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Buying Price</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="buying_price" value="{{ $product->buying_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Selling Price</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="selling_price" value="{{ $product->selling_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3 ">
                                                <label for="exampleInputEmail1">Product Image</label>
                                                <input type="file" class="form-control" id="exampleInputEmail1"
                                                    name="product_image">

                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"></label>
                                                <img id="showImage"
                                                    src="{{ $product->product_image ? asset($product->product_image) : asset('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Update</button>

                                </form>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>
        <!-- end row-->
    </div>

    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_garage: {
                        required: true,
                    },
                    product_store: {
                        required: true,
                    },
                    buying_date: {
                        required: true,
                    },
                    expire_date: {
                        required: true,
                    },
                    buying_price: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter Product Name',
                    },
                    category_id: {
                        required: 'Please Select Category',
                    },
                    supplier_id: {
                        required: 'Please Select Supplier',
                    },
                    product_code: {
                        required: 'Please Enter Product Code',
                    },
                    product_garage: {
                        required: 'Please Enter Product Garage',
                    },
                    product_store: {
                        required: 'Please Enter Product Store',
                    },
                    buying_date: {
                        required: 'Please Enter Buying Date',
                    },
                    expire_date: {
                        required: 'Please Enter Expire Date',
                    },
                    buying_price: {
                        required: 'Please Enter Buying Price',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
