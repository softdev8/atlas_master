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
                    <a href="/admin/candidates/{{ $candidate->id }}/specialisms">Candidate Specialisms</a>
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
            {!! Form::open(['route' => ['admin.candidates.specialisms.update', $candidate->id, $userSpecialism->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
                @csrf
            <div class="margin-bottom-20 text-center">
                {!! Form::label(null, 'Edit Specialism') !!}
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Candidate') }}</label>
                <div class="col-md-9">
                    <select class="form-control input-sm" name="candidate_id" required>
                        <option selected="selected" value="{{ $candidate->id }}">{{ $candidate->forename }} {{ $candidate->surname }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Practice Area</label>
                <div class="col-md-9">
                    <select class="form-control input-sm area-selector" name="area_id" required>
                        <option selected="selected" value="">Pick an area...</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" <?php if($userSpecialism->area_id == $area->id) { echo 'selected';} ?> >{{ $area->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Specialism</label>
                <div class="col-md-9">
                    <select class="form-control input-sm specialism-selector" name="specialism_id" required>
                        <option selected="selected" value="">Pick a specialism...</option>
                        @foreach($specialisms as $specialism)
                            <option value="{{ $specialism->id }}" <?php if($userSpecialism->specialism_id == $specialism->id) { echo 'selected';} ?> >{{ $specialism->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Sub Specialism</label>
                <div class="col-md-9">
                    <select class="form-control input-sm sub-selector" name="subspecialism_id">
                        <option selected="selected" value="">Pick a sub specialism...</option>
                        @foreach($subs as $sub)
                            <option value="{{ $sub->id }}" <?php if($userSpecialism->subspecialism_id == $sub->id) { echo 'selected';} ?> >{{ $sub->title }}</option>
                        @endforeach
                    </select>
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
        $('.area-selector').change(function () {
            let id = $(this).val();
            var inner = '<option selected="selected" value="">Pick a specialism...</option>';

            $.ajax({
                url: '/admin/specialisms/get',
                method: 'GET',
                data: { id: id}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.specialism-selector').html(inner);
                } else {
                    $('.specialism-selector').html('<option selected="selected" value="">Pick a specialism...</option>');
                    $('.sub-selector').html('<option selected="selected" value="">Pick a sub specialism...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });

        $('.specialism-selector').change(function () {
            var id = $(this).val();
            let inner = '<option selected="selected" value="">Pick a sub specialism...</option>';

            $.ajax({
                url: '/admin/subs/get',
                method: 'GET',
                data: { id: id}
            }).done(function(response) {
                if(response != 0){
                    for(var i = 0; i < response.length; i++) {
                        inner += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                    }
                    $('.sub-selector').html(inner);
                } else {
                    $('.sub-selector').html('<option selected="selected" value="">Pick a sub specialism...</option>');
                }
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });
    </script>
@endpush