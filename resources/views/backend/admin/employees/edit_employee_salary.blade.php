@extends('backend.admin.layout.layout')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Edit Employee Salary</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Employee Salary</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Employee Salary</h4>
                                    </div>
                                    <form id="myForm" method="post" action="{{ route('update.employee.salary', $employeesalary->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                                <div class="">

                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            @foreach ($errors->all() as $err )
                                                                {{ $err }}
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <input type="hidden" name="salary_id" value="{{ $employeesalary->id }}">

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Basic Salary<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="basic_salary" value="{{ $employeesalary->basic_salary }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Time Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="time_bonus" value="{{ $employeesalary->time_bonus }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Daily Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="day_bonus" value="{{ $employeesalary->day_bonus }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Yearly Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="yearly_bonus" value="{{ $employeesalary->yearly_bonus }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">8Ray Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="company_bonus" value="{{ $employeesalary->company_bonus }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Movie Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="movie_bonus" value="{{ $employeesalary->movie_bonus }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Daily Movie Bonus<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="daily_movie_bonus" value="{{ $employeesalary->daily_movie_bonus }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Pocket Money<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="pocket_money" value="{{ $employeesalary->pocket_money }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label">Extra Money<span class="text-red">*</span></label>
                                                                <input type="text" class="form-control" name="extra_money" value="{{ $employeesalary->extra_money }}" required>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
                                            <a href="{{ route('all.employee') }}" class="btn btn-danger mt-4 mb-0 text-end">Cancle</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>


@endsection

@push('scripts')
<!-- SHOW PASSWORD JS -->
<script src="{{ asset('backend/js/show-password.min.js') }}"></script>

@endpush
