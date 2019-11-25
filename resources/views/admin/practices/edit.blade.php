@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/practices">Practices</a>
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
            {!! Form::open(['route' => ['admin.practices.update', $area->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
                @csrf
                <div class="margin-bottom-20 text-center">
                    {!! Form::label(null, 'Edit Practice Area') !!}
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $area->title }}" required autofocus>
                    </div>
                </div>
                <div class="text-center margin-top-30">
                    <button type="submit" class="btn btn-success btn-sm">
                        {{ __('Update') }}
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('scripts')

@endpush