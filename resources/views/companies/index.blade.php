@extends('layouts.app')

@section('title',__("companies.title"))
@section('breadcrumb',__("companies.title"))
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-primary" href="{{ route('companies.create') }}">{{ __('default.add') }}</a>
                </div>
                <table 
                    data-toggle="table" 
                    data-ajax="ajaxRequest"
                    data-search="true"
                    data-side-pagination="server"
                    data-pagination="true"
                    data-show-columns="true"
                    data-show-refresh="true"
                    data-show-fullscreen="true"
                    id="company_table"
                    class="table table-responsive-sm table-striped table-bordered" 
                    style="width:100%"
                >
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">#</th>
                            <th data-sortable="true" data-field="name">{{ __('companies.name') }}</th>
                            <th data-sortable="true" data-field="email">{{ __('companies.email') }}</th>
                            <th data-field="logo">{{ __('companies.logo') }}</th>
                            <th data-sortable="true" data-field="website">{{ __('companies.website') }}</th>
                            <th data-field="actions">{{ __('companies.actions') }}</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection