@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/candidates">Candidates</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/candidates/{{ $candidate->id }}/locations">Candidate Locations</a>
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

            {!! Form::open(['route' => ['admin.candidates.locations.store', $candidate->id], 'method' => 'POST', 'class' => 'flex-element-item']) !!}
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'New Location') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Candidate') }}</label>
                    <div class="col-md-10">
                        <select class="form-control input-sm" name="candidate_id" required>
                            <option selected="selected" value="{{ $candidate->id }}">{{ $candidate->forename }} {{ $candidate->surname }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">Country</label>
                    <div class="col-md-10">
                        <select class="form-control input-sm country-selector" name="country_id" required>
                            <option selected="selected" value="">Pick a country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">Region</label>
                    <div class="col-md-10">
                        {!! Form::select('region_id', [], null, ['placeholder' => 'Pick a region...', 'class' => 'form-control region-selector']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">City</label>
                    <div class="col-md-10">
                        {!! Form::select('city_id', [], null, ['placeholder' => 'Pick a city...', 'class' => 'form-control city-selector']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">Address</label>
                    <div class="col-md-10">
                        {!! Form::select('location_id', [], null, ['placeholder' => 'Pick a address...', 'class' => 'form-control location-selector']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" autofocus>
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
            var firm = "<?php echo $candidate->firm_id  ?>";
            var inner = '<option selected="selected" value="">Pick a region...</option>';
            $.ajax({
                url: '/admin/candidates/regions/get',
                method: 'GET',
                data: { id: id, firm: firm}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.region-selector').html(inner);
                } else {
                    $('.region-selector').html('<option selected="selected" value="">Pick a region...</option>');
                    $('.city-selector').html('<option selected="selected" value="">Pick a city...</option>');
                    $('.location-selector').html('<option selected="selected" value="">Pick a address...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });

        $('.region-selector').change(function () {
            var id = $(this).val();
            var firm = "<?php echo $candidate->firm_id  ?>";
            let inner = '<option selected="selected" value="">Pick a city...</option>';
            $.ajax({
                url: '/admin/candidates/cities/get',
                method: 'GET',
                data: { id: id, firm: firm}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.city-selector').html(inner);
                } else {

                    $('.city-selector').html('<option selected="selected" value="">Pick a city...</option>');
                    $('.location-selector').html('<option selected="selected" value="">Pick a address...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });

        $('.city-selector').change(function () {
            var id = $(this).val();
            var firm = "<?php echo $candidate->firm_id  ?>";
            let inner = '<option selected="selected" value="">Pick a address...</option>';

            $.ajax({
                url: '/admin/candidates/firms/locations/get',
                method: 'GET',
                data: { id: id, firm: firm}
            }).done(function(response) {
                console.log(response);
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        if(response[i].address){
                            inner += '<option value="' + response[i].id + '">' + response[i].address + '</option>';
                        } else {
                            inner = '<option value="' + response[i].id + '">unknown</option>';
                        }
                    }
                    $('.location-selector').html(inner);
                } else {
                    $('.location-selector').html('<option selected="selected" value="">Pick a address...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });
    </script>
@endpush