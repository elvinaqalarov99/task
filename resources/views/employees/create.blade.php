@extends('layouts.app')

@section('title',__("employees.title"))
@section('breadcrumb',__("employees.title"))
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="employee-submit-form">
                    @csrf
                    <div class="form-group">
                        <label for="employee_firstname">{{ __('employees.firstname') }}</label>
                        <input type="text" class="form-control" id="employee_firstname" name="firstname">
                        <p id="employee_firstname_err" class="employee_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_lastname">{{ __('employees.lastname') }}</label>
                        <input type="text" class="form-control" id="employee_lastname" name="lastname">
                        <p id="employee_lastname_err" class="employee_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_email">{{ __('employees.email') }}</label>
                        <input type="email" class="form-control" id="employee_email" name="email">
                        <p id="employee_email_err" class="employee_err text-danger"></p>
                    </div> 
                    <div class="form-group">
                        <label for="employee_phone" class="d-block">{{ __('employees.phone') }}</label>
                        <input type="tel" class="form-control" id="employee_phone">
                        <p id="employee_phone_err" class="employee_err text-danger"></p>
                    </div>                   
                    <div class="form-group">
                        <label for="employee_companies">{{ __('employees.company') }}</label>
                        <select class="form-control select2" name="company" id="employee_companies">
                            <option value="" selected disabled>{{ __('default.select') }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        <p id="employee_company_err" class="employee_err text-danger"></p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="employee-submit-btn">{{ __('default.add') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection