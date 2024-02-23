@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Paid Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('employee.salary.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $paySalary->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Add Advance Salary</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="employee_id" class="form-label">Employee Name</label>
                                                <strong style="color : #000;">{{ $paySalary->name }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Salary Month</label>
                                                <strong
                                                    style="color : #000;">{{ date('F', strtotime('-1 month')) }}</strong>
                                                <input type="hidden" name="month"
                                                    value="{{ date('F', strtotime('-1 month')) }}">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Employee Salary</label>
                                                <strong style="color : #000;">{{ $paySalary->salary }}</strong>
                                                <input type="hidden" name="paid_amount" value="{{ $paySalary->salary }}">

                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Advance Salary</label>
                                                <strong
                                                    style="color : #000;">{{ $paySalary['advance']['advance_salary'] }}</strong>
                                                <input type="hidden" name="advance_salary"
                                                    value="{{ $paySalary['advance']['advance_salary'] }}">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Due Salary</label>
                                                @php
                                                    $amount = $paySalary->salary - $paySalary['advance']['advance_salary'];
                                                @endphp
                                                <strong style="color: #000;">
                                                    @if ($paySalary['advance']['advance_salary'] == null)
                                                        <span>No Salary</span>
                                                    @else
                                                        {{ round($amount) }}
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="due_salary" value="{{ round($amount) }}">

                                            </div>
                                        </div>


                                    </div> <!-- end row -->


                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Paid Salary</button>
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
