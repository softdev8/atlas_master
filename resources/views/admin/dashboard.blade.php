@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block ">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-active">
                    <a href="/admin">AdminPanel</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div data-pages="card" class="card card-default background-primary">
                <div class="card-header  ">
                    <div class="card-title">XML AUTO UPDATE</div>
                </div>
                <div class="card-block">
                    <div class="text-center">


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div data-pages="card" class="card card-default background-danger">
                <div class="card-header  ">
                    <div class="card-title">XML AUTO UPDATE</div>
                </div>
                <div class="card-block">
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div data-pages="card" class="card card-default background-primary">
                <div class="card-header  ">
                    <div class="card-title">XML AUTO UPDATE</div>
                </div>
                <div class="card-block">
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div data-pages="card" class="card card-default background-success">
                <div class="card-header  ">
                    <div class="card-title">XML AUTO UPDATE</div>
                </div>
                <div class="card-block">
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('styles')
<script src="https://js.chargebee.com/v2/chargebee.js" data-cb-site="clickimage-test" ></script>
@endpush

@push('scripts')

@endpush