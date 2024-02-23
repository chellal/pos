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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Customer</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Edit Customer</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form method="Post" action="{{ route('update.customer') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Edit Customer</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Name</label>
                                                <input value="{{ $customer->name }}" type="text" name="name"
                                                    class="form-control  @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Email</label>
                                                <input value="{{ $customer->email }}" type="email" name="email"
                                                    class="form-control  @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Phone</label>
                                                <input value="{{ $customer->phone }}" type="text" name="phone"
                                                    class="form-control  @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Adresse</label>
                                                <input value="{{ $customer->adresse }}" type="text" name="adresse"
                                                    class="form-control  @error('adresse') is-invalid @enderror">
                                                @error('adresse')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Shop Name</label>
                                                <input type="text" value=" {{ $customer->shopname }}" name="shopname"
                                                    class="form-control  @error('shopname') is-invalid @enderror">
                                                @error('shopname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Account Holder</label>
                                                <input type="text" value=" {{ $customer->account_holder }}"
                                                    name="account_holder"
                                                    class="form-control  @error('account_holder') is-invalid @enderror">
                                                @error('account_holder')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Account Number</label>
                                                <input type="text" value=" {{ $customer->account_number }}"
                                                    name="account_number"
                                                    class="form-control  @error('account_number') is-invalid @enderror">
                                                @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Bank Name</label>
                                                <input type="text" value=" {{ $customer->bank_name }}" name="bank_name"
                                                    class="form-control  @error('bank_name') is-invalid @enderror">
                                                @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer Bank Branch</label>
                                                <input type="text" value=" {{ $customer->bank_branch }}"
                                                    name="bank_branch"
                                                    class="form-control  @error('bank_branch') is-invalid @enderror">
                                                @error('bank_branch')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Customer City</label>
                                                <input type="text" value=" {{ $customer->city }}" name="city"
                                                    class="form-control  @error('city') is-invalid @enderror">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Customer
                                                    Image</label>
                                                <input type="file" id="image" name="image" class="form-control"
                                                    name="image">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"></label>
                                                <img id="showImage"
                                                    src="{{ !empty($customer->image) ? asset($customer->image) : asset('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
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
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

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
