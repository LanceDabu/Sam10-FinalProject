@extends('layouts.app')

@section('content')

    <div class="container">

    <div class="text-center mt-4">
            <img src="https://blogger.googleusercontent.com/img/a/AVvXsEjXJ_P_N_B_fmGaZdLZ-QR4v-eRGaMg1zZYVaZDATPNxQicERdDaYu4YxrT0colPxzw3pHQth9iueilKFxBg5ZPqj8q-798SDzk9TjVr2GRbwMzhFM4Y-yXJqENB_2mrDvHf8LVfZ_Da8UJrSC1J9138foLLKhWRYJGnVaPMl1INYiBm7YEHDguT5UVVUpo" alt="Company Logo" style="width: 100px; height: auto;">
        </div>

        <h5 align="center" class="mt-3 custom-title">MsAzure Employee Management</h5>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-15">

                <div class="form-area">
                    <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                        {!! csrf_field() !!}
                        @method("PATCH")

                        <!-- Display Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control @error('emp_name') is-invalid @enderror" name="emp_name" value="{{ old('emp_name', $employee->emp_name) }}">
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob', $employee->dob ? $employee->dob->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Job Position</label>
                                <select class="form-control @error('job_position') is-invalid @enderror " name="job_position">
                                <option value="" disabled {{ old('job_position', $employee->job_position) == '' ? 'selected' : '' }}>Choose Job Position</option>
                                <option value="Developer" {{ old('job_position', $employee->job_position) == 'Developer' ? 'selected' : '' }}>Developer</option>
                                <option value="Administrator" {{ old('job_position', $employee->job_position) == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                <option value="Manager" {{ old('job_position', $employee->job_position) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="HR" {{ old('job_position', $employee->job_position) == 'HR' ? 'selected' : '' }}>HR</option>
                                <option value="Support" {{ old('job_position', $employee->job_position) == 'Support' ? 'selected' : '' }}>Support</option>
                            </select>
                            </div>
                            <div class="col-md-6">
                                <label>Contact No.</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $employee->phone) }}">
                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $employee->address) }}">                              
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $employee->email) }}">                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Salary</label>
                                <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary', $employee->salary) }}">
                            </div>
                            <div class="col-md-6">
                                <label>Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="" disabled {{ old('status', $employee->status) == '' ? 'selected' : '' }}>Choose Status</option>
                                    <option value="1" {{ old('status', $employee->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $employee->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    <option value="2" {{ old('status', $employee->status) == '2' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Back</button>

                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
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

        .img-thumbnail {
            display: block;
            margin-top: 10px;
        }
    </style>
@endpush
