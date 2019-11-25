@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/subs">SubSpecialism</a>
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
            {!! Form::open(['route' => ['admin.subs.update', $sub->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'Edit SubSpecialism') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-9">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $sub->title }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">SubSpecialism</label>
                    <div class="col-md-9">
                        <select class="form-control input-sm company-id-selector" name="specialism_id" required>
                            @foreach($specialisms as $specialism)
                                <option value="{{ $specialism->id }}">{{ $specialism->title }}</option>
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

@endpush