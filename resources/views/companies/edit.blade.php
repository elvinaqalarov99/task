@extends('layouts.app')

@section('title',__("companies.title"))
@section('breadcrumb',__("companies.title"))
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="company-edit-form">
                    @csrf
                    @method('put')
                    <input type="hidden" name="" id="company_id" name="company_id" value="{{ $company->id }}">
                    <div class="form-group">
                        <label for="company_logo">{{ __('companies.logo') }}</label>
                        <input type="file" class="form-control-file mb-3" id="company_logo" name="logo">
                        @if (isset($company->logo))
                            <img class="img-thumbnail" src="{{ asset('storage/'.$company->logo) }}" alt="logo" width="100" height="100" />                        
                        @else
                            <p class="text-info">{{ __('default.no_logo') }}</p>
                        @endif
                        <p id="company_logo_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_name">{{ __('companies.name') }}</label>
                        <input type="text" class="form-control" id="company_name" name="name" value="{{ $company->name }}">
                        <p id="company_name_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_email">{{ __('companies.email') }}</label>
                        <input type="text" class="form-control" id="company_email" name="email" value="{{ $company->email }}">
                        <p id="company_email_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_website">{{ __('companies.website') }}</label>
                        <input type="text" class="form-control" id="company_website" name='website' value="{{ $company->website }}">
                        <p id="company_website_err" class="company_err text-danger"></p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="company-submit-btn">{{ __('default.edit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection