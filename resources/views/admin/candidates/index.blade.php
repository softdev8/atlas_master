@extends('layouts.admin')

@section('content')

    <div class="breadcrumb-block bg-white">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-active">
                    Candidates
                </li>
            </ol>
        </div>
        <div class="breadcrumb-element">
            {{--<button class="btn btn-success btn-sm create-user-btn" data-toggle="modal" data-target="#create-user-modal">Register new user</button>--}}
            <a href="candidates/create" class="btn btn-success btn-sm create-user-btn" title="User Edit">
                Add new candidate
            </a>
        </div>
    </div>

    <div class="content-block">
        {!! $dataTable->table() !!}
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush