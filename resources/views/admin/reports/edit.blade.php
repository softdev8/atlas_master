@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/reports">Reports</a>
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
            {!! Form::open(['route' => ['admin.reports.update', $report->id], 'method' => 'PATCH', 'class' => 'flex-element-item']) !!}
            @csrf
            <div class="margin-bottom-20 text-center">
                {!! Form::label(null, 'User report') !!}
            </div>

            <div class="form-group row">
                <label for="user" class="col-md-2 col-form-label text-md-right">{{ __('User') }}</label>

                <div class="col-md-10">
                    <input id="user" type="text" class="form-control" name="user" value="{{ $report->user->name }}" required disabled>
                </div>
            </div>


            <div class="form-group row">
                <label for="candidate" class="col-md-2 col-form-label text-md-right">{{ __('Candidate') }}</label>

                <div class="col-md-10">
                    <input id="candidate" type="text" class="form-control" name="candidate" value="{{ $report->candidate->forename.' '.$report->candidate->surname }}" required disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-10">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" disabled>{{ $report->description }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Status</label>
                <div class="col-md-10">
                    <select class="form-control input-sm city-selector" name="status" required>
                        <option value="0"  <?php if($report->status == 0) { echo 'selected';} ?> >New</option>
                        <option value="1"  <?php if($report->status == 1) { echo 'selected';} ?> >In process</option>
                        <option value="2"  <?php if($report->status == 2) { echo 'selected';} ?> >Complete</option>
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