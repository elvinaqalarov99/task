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
                <table data-toggle="table" data-pagination="true"
                data-search="true" class="table-responsive-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">#</th>
                            <th data-sortable="true" data-field="firstname">{{ __('employees.firstname') }}</th>
                            <th data-sortable="true" data-field="lastname">{{ __('employees.lastname') }}</th>
                            <th data-sortable="true" data-field="email">{{ __('employees.email') }}</th>
                            <th data-sortable="true" data-field="phone">{{ __('employees.phone') }}</th>
                            <th data-sortable="true" data-field="company">{{ __('employees.company') }}</th>
                            <th>{{ __('employees.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->firstname }}</td>
                                <td>{{ $employee->lastname }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td>
                                    <i class="fa fa-times mr-3 text-danger pointer" onclick="deleteConfirmation({{ $employee->id }},'employees')"></i>
                                    <a href="/dashboard/employees/{{ $employee->id }}/edit"><i class="fa fa-edit text-primary"></i></a>    
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