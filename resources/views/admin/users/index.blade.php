@extends('layouts.admin')

@section('content')

    <div class="breadcrumb-block bg-white">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-active">
                    Users
                </li>
            </ol>
        </div>
        <div class="breadcrumb-element">
            {{--<button class="btn btn-success btn-sm create-user-btn" data-toggle="modal" data-target="#create-user-modal">Register new user</button>--}}
            <a href="users/create" class="btn btn-success btn-sm create-user-btn" title="User Edit">
                Register new user
            </a>
        </div>
    </div>

    <div class="content-block">
        {!! $dataTable->table() !!}
    </div>



    <!-- Create User modal -->
    {{--
    <div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close btn-xs" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times modal-close"></i></button>
                    <hr>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.registration') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Company Name</label>
                            <div class="col-md-8">
                                <select class="form-control input-sm company-id-selector" name="company_id" required></select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success btn-sm">
                                    {{ __('Confirm Registration') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    --}}


@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}


    {{--<script>
        $('.data-tables').delegate('.create-user-btn', 'click', function(){
            var company_id = $(this).data('company');
            var id = $(this).val();
            var action = '/admin/templates/copy/'+id;
            $('.copy-modal-form').attr('action', action);
            $('.template-id-label').html(id);

            $.ajax({
                url: '/admin/companies/all',
                method: 'GET'
            }).done(function(response) {
                response = response.sort((a, b) => a.company_name > b.company_name ? 1 : -1)
                var inner = []; var selected = null;
                for (let i=0; i<response.length; i++) {
                    if(response[i].id == company_id){
                        selected = 'selected';
                    } else {
                        selected = null;
                    }
                    inner.push('<option value="'+response[i].id+'" '+selected+' >'+response[i].company_name+'</option>')
                }
                $('.company-id-selector').html(inner);
            }).fail(function(xhr, status, error) {
                console.log('Ajax Error');
            });
        });
    </script>--}}

@endpush