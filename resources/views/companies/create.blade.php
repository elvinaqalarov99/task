@extends('layouts.app')

@section('title','Companies')
@section('breadcrumb','Companies')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="company-submit-form">
                    @csrf
                    <div class="form-group">
                        <label for="company_logo">Logo</label>
                        <input type="file" class="form-control-file" id="company_logo" name="logo">
                        <p id="company_logo_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_name">Name</label>
                        <input type="text" class="form-control" id="company_name" name="name">
                        <p id="company_name_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_email">Email</label>
                        <input type="text" class="form-control" id="company_email" name="email">
                        <p id="company_email_err" class="company_err text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="company_website">Website</label>
                        <input type="text" class="form-control" id="company_website" name='website'>
                        <p id="company_website_err" class="company_err text-danger"></p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="company-submit-btn">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection