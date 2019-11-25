@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/specialisms">Specialism</a>
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
            <form method="POST" class="flex-element-item" action="{{ route('admin.specialisms.store') }}">
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'New Specialism') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Practice Area</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm company-id-selector" name="area_id" required>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->title }}</option>
                            @endforeach
                        </select>
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