@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/types">Types&Rankings</a>
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
            {!! Form::open(['route' => ['admin.types.update', $type->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'Edit Types&Ranking') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $type->title }}" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Type</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm company-id-selector" name="flag" required>
                            <option value="type" <?php if($type->flag == "type") { echo 'selected';} ?> > Type</option>
                            <option value="rank" <?php if($type->flag == "rank") { echo 'selected';} ?> > Rank</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="min" class="col-md-3 col-form-label text-md-right">{{ __('Min') }}</label>

                    <div class="col-md-9">
                        <input id="min" type="number" class="form-control{{ $errors->has('min') ? ' is-invalid' : '' }}" name="min" value="{{ $type->min }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="max" class="col-md-3 col-form-label text-md-right">{{ __('Max') }}</label>

                    <div class="col-md-9">
                        <input id="max" type="number" class="form-control{{ $errors->has('max') ? ' is-invalid' : '' }}" name="max" value="{{ $type->max }}" required autofocus>
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

@endpush