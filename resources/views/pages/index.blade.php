@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Logo Section -->
        <div class="text-center mt-4">
            <img src="https://blogger.googleusercontent.com/img/a/AVvXsEjXJ_P_N_B_fmGaZdLZ-QR4v-eRGaMg1zZYVaZDATPNxQicERdDaYu4YxrT0colPxzw3pHQth9iueilKFxBg5ZPqj8q-798SDzk9TjVr2GRbwMzhFM4Y-yXJqENB_2mrDvHf8LVfZ_Da8UJrSC1J9138foLLKhWRYJGnVaPMl1INYiBm7YEHDguT5UVVUpo" alt="Company Logo" style="width: 100px; height: auto;">
        </div>

        <h5 align="center" class="mt-3 custom-title">MsAzure Employee Management</h5>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-15">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-area">
                    <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row custom-margin">
                            <div class="col-md-6">
                                <label>Employee Name</label>
                                <input type="text" class="form-control @error('emp_name') is-invalid @enderror" name="emp_name" value="{{ old('emp_name') }}" placeholder="Enter employee name">
                            </div>
                            <div class="col-md-6">
                                <label>Job Position</label>
                                <select class="form-control @error('job_position') is-invalid @enderror" name="job_position">
                                <option value="" disabled selected>Choose Job Position</option>
                                <option value="Developer" {{ old('job_position') == 'Developer' ? 'selected' : '' }}>Developer</option>
                                <option value="Administrator" {{ old('job_position') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                <option value="Manager" {{ old('job_position') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="HR" {{ old('job_position') == 'HR' ? 'selected' : '' }}>HR</option>
                                <option value="Support" {{ old('job_position') == 'Support' ? 'selected' : '' }}>Support</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}">
                            </div>
                           
                            <div class="col-md-6">
                                <label>Contact No.</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"  name="phone" value="{{ old('phone') }}" placeholder="Enter contact number">
                              
                            </div>
                        </div>
                        <div class="row custom-margin">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email address">
                            </div>
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="row custom-margin">
                            <div class="col-md-6">
                                <label>Salary</label>
                                <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" placeholder="Enter salary">
                            </div>
                            <div class="col-md-6">
                                <label>Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="" disabled selected>Choose Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>
                        <!-- Center the Register button and make it wide -->
                        <div class="row">
                        <div class="col-md-12 mt-3 text-center">
                            <!-- Custom width using inline CSS -->
                            <input type="submit" class="btn btn-primary" value="Register" style="width: 200px;">
                        </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered mt-5">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Job Position</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $employee->emp_name }}</td>
                                <td>{{ $employee->job_position }}</td>
                                <td>{{ $employee->dob }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>{{ $employee->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </button>
                                    </a>
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>
        .form-area {
            padding: 20px;
            margin-top: 20px;
            background-color: #b3e5fc;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #e3f2fd;
        }

        /* Custom margin to ensure the form has space between fields */
        .custom-margin {
            margin-bottom: 15px;
        }

        /* Additional custom styles for centering */
        .custom-title {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        /* Ensuring the table expands and the text does not get cut off */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            table-layout: auto; /* Adjust table layout to auto */
        }

        th, td {
            white-space: nowrap; /* Prevent text wrapping */
            text-overflow: ellipsis; /* Show ellipsis for overflowing text */
            overflow: hidden;
        }
    </style>
@endpush
