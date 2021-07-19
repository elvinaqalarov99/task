@extends('layouts.app')

@section('title','Employees Dashboard')
@section('breadcrumb','Employees')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="employee-edit-form">
                    @csrf
                    @method('put')
                    <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}">
                    <div class="form-group">
                        <label for="employee_firstname">Name</label>
                        <input type="text" class="form-control" id="employee_firstname" name="firstname" value="{{ $employee->firstname }}">
                        <p id="employee_firstname_err" class="employee_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_lastname">Surname</label>
                        <input type="text" class="form-control" id="employee_lastname" name="lastname" value="{{ $employee->lastname }}">
                        <p id="employee_lastname_err" class="employee_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_email">Email</label>
                        <input type="email" class="form-control" id="employee_email" name="email" value="{{ $employee->email }}">
                        <p id="employee_email_err" class="employee_err text-danger"></p>
                    </div> 
                    <div class="form-group">
                        <label for="employee_phone" class="d-block">Phone</label>
                        <input type="tel" class="form-control" id="employee_phone" value="{{ $employee->phone }}">
                        <p id="employee_phone_err" class="employee_err text-danger"></p>
                    </div>                   
                    <div class="form-group">
                        <label for="employee_company">Companies</label>
                        <select class="form-control select2" name="company" id="employee_company">
                            <option value="" selected disabled>Select a company</option>
                            @foreach ($companies as $company)
                                @if ($company->id === $employee->company->id)
                                    <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <p id="employee_company_err" class="employee_err text-danger"></p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="employee-submit-btn">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection