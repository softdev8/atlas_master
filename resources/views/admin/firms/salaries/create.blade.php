@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/firms">Firms</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/firms/{{ $firm->id }}/locations">Firms Salaries</a>
                </li>
                <li class="breadcrumb-active">
                    Create
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('flex-content')

    <div id="flex-container">
        <div class="flex-element-cart">

            {!! Form::open(['route' => ['admin.firms.salaries.store', $firm->id], 'method' => 'POST', 'class' => 'flex-element-item']) !!}
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'New Salary Entry') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Firm') }}</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm" name="firm_id" required>
                            <option selected="selected" value="{{ $firm->id }}">{{ $firm->title }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">PQE Level</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm country-selector" name="pqe" required>
                            <option selected="selected" value="">Pick a PQE level...</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->title }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Min Salary') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="number" class="form-control{{ $errors->has('min') ? ' is-invalid' : '' }}" name="min" value="{{ old('min') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Max Salary') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="number" class="form-control{{ $errors->has('max') ? ' is-invalid' : '' }}" name="max" value="{{ old('max') }}" required autofocus>
                    </div>
                </div>
                <div class="text-center margin-top-30">
                    <button type="submit" class="btn btn-success btn-sm">
                        {{ __('Save') }}
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('.country-selector').change(function () {
            let id = $(this).val();
            var inner = '<option selected="selected" value="">Pick a region...</option>';
            $.ajax({
                url: '/admin/regions/get',
                method: 'GET',
                data: { id: id}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.region-selector').html(inner);
                } else {
                    $('.region-selector').html(inner);
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });

        $('.region-selector').change(function () {
            var id = $(this).val();
            let inner = '<option selected="selected" value="">Pick a city...</option>';
            $.ajax({
                url: '/admin/cities/get',
                method: 'GET',
                data: { id: id}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.city-selector').html(inner);
                } else {
                    $('.city-selector').html(inner);
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });
    </script>
@endpush