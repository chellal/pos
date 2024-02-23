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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit employee</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Edit employee</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form method="Post" action="{{ route('update.employee') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Edit Employee</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Name</label>
                                                <input value="{{ $employee->name }}" type="text" name="name"
                                                    class="form-control  @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Email</label>
                                                <input value="{{ $employee->email }}" type="email" name="email"
                                                    class="form-control  @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Phone</label>
                                                <input value="{{ $employee->phone }}" type="text" name="phone"
                                                    class="form-control  @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Adresse</label>
                                                <input value="{{ $employee->adresse }}" type="text" name="adresse"
                                                    class="form-control  @error('adresse') is-invalid @enderror">
                                                @error('adresse')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Experience</label>
                                                <select name="experience"
                                                    class="form-select @error('experience') is-invalid @enderror"
                                                    id="example-select">
                                                    <option value="1"
                                                        {{ '1' == $employee->experience ? 'selected' : '' }}>
                                                        1 Year
                                                    </option>
                                                    <option value="2"
                                                        {{ '2' == $employee->experience ? 'selected' : '' }}>2 Years
                                                    </option>
                                                    <option value="3"
                                                        {{ '3' == $employee->experience ? 'selected' : '' }}>3 Years
                                                    </option>
                                                    <option value="4"
                                                        {{ '4' == $employee->experience ? 'selected' : '' }}>4 Years
                                                    </option>
                                                </select>
                                                @error('experience')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Salary</label>
                                                <input value="{{ $employee->salary }}" type="text" name="salary"
                                                    class="form-control  @error('salary') is-invalid @enderror">
                                                @error('salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee Vacation</label>
                                                <input value="{{ $employee->vacation }}" type="text" name="vacation"
                                                    class="form-control  @error('vacation') is-invalid @enderror">
                                                @error('vacation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Employee City</label>
                                                <input value="{{ $employee->city }}" type="text" name="city"
                                                    class="form-control  @error('city') is-invalid @enderror">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Employee
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
                                                    src="{{ !empty($employee->image) ? asset($employee->image) : asset('upload/no_image.jpg') }}"
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
