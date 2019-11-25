@extends('layouts.admin')

@section('content')

    <div class="breadcrumb-block bg-white">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/candidates">Candidates</a>
                </li>
                <li class="breadcrumb-active">
                    Edit
                </li>
            </ol>
        </div>
    </div>
    <div class="content-block">

        {!! Form::open(['route' => ['admin.candidates.update', $candidate->id], 'method' => 'PATCH']) !!}
        <div class="form-group row">
            <label for="forename" class="col-md-1 col-form-label text-md-right">{{ __('Forename') }}</label>
            <div class="col-md-11">
                <input id="forename" type="text" class="form-control{{ $errors->has('forename') ? ' is-invalid' : '' }}" name="forename" value="{{ $candidate->forename }}" required>
                @if ($errors->has('forename'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('forename') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="surname" class="col-md-1 col-form-label text-md-right">{{ __('Surname') }}</label>
            <div class="col-md-11">
                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $candidate->surname }}" required>
                @if ($errors->has('surname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-1 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="col-md-11">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $candidate->email }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-1 col-form-label text-md-right">Firm</label>
            <div class="col-md-11">
                <select class="form-control input-sm company-id-selector" name="firm_id" required>
                    @foreach($firms as $firm)
                        <option value="{{ $firm->id }}" <?php if($candidate->firm_id == $firm->id) { echo 'selected';} ?> >{{ $firm->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pqe" class="col-md-1 col-form-label text-md-right">{{ __('PQE Level') }}</label>
            <div class="col-md-11">
                <input id="pqe" type="text" class="form-control{{ $errors->has('pqe') ? ' is-invalid' : '' }}" name="pqe" value="{{ $candidate->pqe }}" required>
                @if ($errors->has('pqe'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('pqe') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="ref_num" class="col-md-1 col-form-label text-md-right">{{ __('REF Number') }}</label>
            <div class="col-md-11">
                <input id="ref_num" type="text" class="form-control{{ $errors->has('ref_num') ? ' is-invalid' : '' }}" name="ref_num" value="{{ $candidate->ref_num }}" required>
                @if ($errors->has('ref_num'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ref_num') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="workphone" class="col-md-1 col-form-label text-md-right">{{ __('Workphone') }}</label>
            <div class="col-md-11">
                <input id="workphone" type="text" class="form-control{{ $errors->has('workphone') ? ' is-invalid' : '' }}" name="workphone" value="{{ $candidate->workphone }}" required>
                @if ($errors->has('workphone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('workphone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="mobile_phone" class="col-md-1 col-form-label text-md-right">{{ __('Mobile phone') }}</label>
            <div class="col-md-11">
                <input id="mobile_phone" type="text" class="form-control{{ $errors->has('mobile_phone') ? ' is-invalid' : '' }}" name="mobile_phone" value="{{ $candidate->mobile_phone }}" required>
                @if ($errors->has('mobile_phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mobile_phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="website" class="col-md-1 col-form-label text-md-right">{{ __('Website') }}</label>
            <div class="col-md-11">
                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ $candidate->website }}" required>
                @if ($errors->has('website'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('website') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="linked_in" class="col-md-1 col-form-label text-md-right">{{ __('Linked In') }}</label>
            <div class="col-md-11">
                <input id="linked_in" type="text" class="form-control{{ $errors->has('linked_in') ? ' is-invalid' : '' }}" name="linked_in" value="{{ $candidate->linked_in }}" required>
                @if ($errors->has('linked_in'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('linked_in') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="admitted_date" class="col-md-1 col-form-label text-md-right">{{ __('Admitted Date') }}</label>
            <div class="col-md-11">
                <input id="admitted_date" type="text" class="form-control{{ $errors->has('admitted_date') ? ' is-invalid' : '' }} datetimepicker" name="admitted_date" value="{{ $candidate->admitted_date }}" required>
                @if ($errors->has('admitted_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('admitted_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="changed_job_date" class="col-md-1 col-form-label text-md-right">{{ __('Job Date') }}</label>
            <div class="col-md-11">
                <input id="changed_job_date" type="text" class="form-control{{ $errors->has('changed_job_date') ? ' is-invalid' : '' }} datetimepicker" name="changed_job_date" value="{{ $candidate->changed_job_date }}" required>
                @if ($errors->has('changed_job_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('changed_job_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="gender" class="col-md-1 col-form-label text-md-right">{{ __('Gender') }}</label>
            <div class="col-md-11">
                {!! Form::select('gender', ['-' => 'Not specified', 'male' => 'Male', 'female' => 'Female'],$candidate->gender, ['class'=>'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="job_title" class="col-md-1 col-form-label text-md-right">{{ __('Job title') }}</label>
            <div class="col-md-11">
                {!! Form::select('job_title', ['-' => 'Not specified', 'partner' => 'Partner', 'associate' => 'Associate', 'PSL' => 'PSL'], $candidate->job_title, ['class'=>'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="law_society_link" class="col-md-1 col-form-label text-md-right">{{ __('Law society link') }}</label>
            <div class="col-md-11">
                <input id="law_society_link" type="text" class="form-control{{ $errors->has('law_society_link') ? ' is-invalid' : '' }}" name="law_society_link" value="{{ $candidate->law_society_link }}" required>
                @if ($errors->has('law_society_link'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('law_society_link') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="school" class="col-md-1 col-form-label text-md-right">{{ __('School') }}</label>
            <div class="col-md-11">
                <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" value="{{ $candidate->school }}" required>
                @if ($errors->has('school'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('school') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="university" class="col-md-1 col-form-label text-md-right">{{ __('University') }}</label>
            <div class="col-md-11">
                <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university" value="{{ $candidate->university }}" required>
                @if ($errors->has('university'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('university') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        @for($i = 0; $i < 4; $i++)
            @if(isset($candidate->links[$i]['link']))
                <div class="form-group row">
                    <label for="links1" class="col-md-1 col-form-label text-md-right">{{ __('Link') }}</label>
                    <div class="col-md-11">
                        <input id="links1" type="text" class="form-control" name="links[]" value="{{  $candidate->links[$i]['link'] }}">
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label for="links1" class="col-md-1 col-form-label text-md-right">{{ __('Link') }}</label>
                    <div class="col-md-11">
                        <input id="links1" type="text" class="form-control" name="links[]" value="">
                    </div>
                </div>
            @endif
        @endfor
        @for($i = 0; $i < 2; $i++)
            @if(isset($candidate->jobs[$i]['previous_firm']))
                <div class="form-group row">
                    <label for="job1" class="col-md-1 col-form-label text-md-right">{{ __('Previous Firm') }}</label>
                    <div class="col-md-11">
                        <input id="job1" type="text" class="form-control" name="jobs[{{$i}}][previous_firm]" value="{{  $candidate->jobs[$i]['previous_firm'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="datejob1" class="col-md-1 col-form-label text-md-right">{{ __('Previous Date') }}</label>
                    <div class="col-md-11">
                        <input id="datejob1" type="text" class="form-control datetimepicker" name="jobs[{{$i}}][previous_date]" value="{{  $candidate->jobs[$i]['previous_date'] }}">
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label for="job1" class="col-md-1 col-form-label text-md-right">{{ __('Previous Firm') }}</label>
                    <div class="col-md-11">
                        <input id="job1" type="text" class="form-control" name="jobs[{{$i}}][previous_firm]" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="datejob1" class="col-md-1 col-form-label text-md-right">{{ __('Previous Date') }}</label>
                    <div class="col-md-11">
                        <input id="datejob1" type="text" class="form-control datetimepicker" name="jobs[{{$i}}][previous_date]" value="">
                    </div>
                </div>
            @endif
        @endfor

        <div class="form-group row margin-top-30">
            <div class="col-md-12">
                <button id="save_btn" class="btn btn-primary btn-sm">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
@endsection

@push('scripts')
    <script>
        $.datetimepicker.setLocale('en');
        $('.datetimepicker').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
        });
    </script>
@endpush