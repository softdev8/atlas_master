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
            <form method="POST" class="flex-element-item" action="{{ route('admin.firms.store') }}">
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'New Firm') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">Type</label>
                    <div class="col-md-10">
                        <select class="form-control input-sm city-selector" name="type" required>
                            <option selected="selected" value="">Pick a Type...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" >{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Ranking') }}</label>

                    <div class="col-md-10">
                        <input id="title" type="number" class="form-control{{ $errors->has('ranking') ? ' is-invalid' : '' }}" name="ranking" value="{{ old('ranking') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="website" class="col-md-2 col-form-label text-md-right">{{ __('Website') }}</label>

                    <div class="col-md-10">
                        <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ old('website') }}"  autofocus>
                    </div>
                </div>
                <div class="text-center margin-top-30">
                    <button type="submit" class="btn btn-success btn-sm">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')

@endpush