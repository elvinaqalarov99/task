@extends('layouts.app')

@section('title', __("employees.title"))
@section('breadcrumb',__("employees.title"))
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-primary" href="{{ route('employees.create') }}">{{ __('default.add') }}</a>
                </div>
                <table 
                    data-toggle="table" 
                    data-ajax="ajaxRequest"
                    data-search="true"
                    data-side-pagination="server"
                    data-pagination="true"
                    data-show-columns="true"
                    data-show-fullscreen="true"
                    data-show-refresh="true"
                    id="employees_table"
                    class="table-responsive-sm table-striped table-bordered" 
                    style="width:100%"
                >
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">#</th>
                            <th data-sortable="true" data-field="firstname">{{ __('employees.firstname') }}</th>
                            <th data-sortable="true" data-field="lastname">{{ __('employees.lastname') }}</th>
                            <th data-sortable="true" data-field="email">{{ __('employees.email') }}</th>
                            <th data-sortable="true" data-field="phone">{{ __('employees.phone') }}</th>
                            <th data-sortable="true" data-field="company.name">{{ __('employees.company') }}</th>
                            <th data-field="actions">{{ __('employees.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection