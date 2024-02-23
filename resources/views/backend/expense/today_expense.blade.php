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
                            <a href="{{ route('add.expense') }}"
                                class="btn btn-primary rounded-pill waves-effect waves-light">Add Expense</a>
                        </div>
                        <h4 class="page-title">Today Expense</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 style="color: rgb(94, 92, 92);font-size: 30px;" align="center">Total : {{ $sum_amount }}
                                Dhs
                            </h4>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($today as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->year }}</td>
                                            <td>
                                                <a href="{{ route('edit.expense', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                                <a href="{{ route('delete.expense', $item->id) }}" id="delete"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

            <!-- end row-->

        </div> <!-- container -->

    </div>
@endsection
