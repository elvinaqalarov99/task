@extends('layouts.app')

@section('title','Companies')
@section('breadcrumb','Companies')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-primary" href="{{ route('companies.create') }}">Add</a>
                </div>
                <table data-toggle="table" data-pagination="true"
                data-search="true" class="table table-responsive-sm table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">#</th>
                            <th data-sortable="true" data-field="name">Name</th>
                            <th data-sortable="true" data-field="email">Email</th>
                            <th>Logo</th>
                            <th data-sortable="true" data-field="website">Website</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td><img class="img-thumbnail" src="{{ asset('storage/'.$company->logo) }}" alt="logo" width="50" height="50"/></td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    <i class="fa fa-times mr-3 text-danger pointer" onclick="deleteConfirmation({{ $company->id }},'companies')"></i>
                                    <a href="/dashboard/companies/{{ $company->id }}/edit"><i class="fa fa-edit text-primary"></i></a>    
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