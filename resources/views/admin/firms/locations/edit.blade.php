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
                    <a href="/admin/firms/{{ $firm->id }}/locations">Firms Locations</a>
                </li>
                <li class="breadcrumb-active">
                    Edit
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('flex-content')

    <div id="flex-container">
        <div class="flex-element-cart">
            {!! Form::open(['route' => ['admin.firms.locations.update', $firm->id, $location->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
                @csrf
            <div class="margin-bottom-20 text-center">
                {!! Form::label(null, 'Edit Location') !!}
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Firm') }}</label>
                <div class="col-md-10">
                    <select class="form-control input-sm" name="firm_id" required>
                        <option selected="selected" value="{{ $firm->id }}">{{ $firm->title }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Country</label>
                <div class="col-md-10">
                    <select class="form-control input-sm country-selector" name="country_id" required>
                        <option selected="selected" value="">Pick a country...</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"  <?php if($location->country_id == $country->id) { echo 'selected';} ?> >{{ $country->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Region</label>
                <div class="col-md-10">
                    <select class="form-control input-sm region-selector" name="region_id" required>
                        <option selected="selected" value="">Pick a region...</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}"  <?php if($location->region_id == $region->id) { echo 'selected';} ?> >{{ $region->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">City</label>
                <div class="col-md-10">
                    <select class="form-control input-sm city-selector" name="city_id" >
                        <option selected="selected" value="">Pick a city...</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}"  <?php if($location->city_id == $city->id) { echo 'selected';} ?> >{{ $city->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-10">
                    <input id="title" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $location->address  }}" autofocus>
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
                    $('.region-selector').html('<option selected="selected" value="">Pick a region...</option>');
                    $('.city-selector').html('<option selected="selected" value="">Pick a city...</option>');
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
                    //$('.region-selector').html('<option selected="selected" value="">Pick a region...</option>');
                    $('.city-selector').html('<option selected="selected" value="">Pick a city...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });
    </script>
@endpush