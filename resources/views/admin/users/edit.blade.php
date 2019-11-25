@extends('layouts.admin')

@section('content')

    <div class="breadcrumb-block bg-white">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">AdminPanel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/users">Users</a>
                </li>
                <li class="breadcrumb-active">
                    Edit
                </li>
            </ol>
        </div>
    </div>
    <div class="content-block">

        {!! Form::open(['route' => ['admin.users.update', $user->id], 'method' => 'PATCH']) !!}
        <div class="row ">
            <div class="col-md-12">
                {{-- Main Picture --}}
                <label for="">Company User Avatar (100px * 100px)</label>
                <div class="image-editor margin-bottom-40">
                    <div class="cropit-preview" style="margin-top: 25px; width: 100px; height: 100px" ></div>
                    <span class="btn btn-success fileinput-button btn-sm" style="float: left; margin-right: 20px">
            		    <i class="glyphicon glyphicon-plus"></i>
            		    <span>Add picture...</span>
            		    <input type="file" class="cropit-image-input">
         	        </span>
                    <input type="hidden" id="export_crop1">
                    <br><br>
                    <div class="image-size-label">Change scale</div>
                    <input type="range" class="cropit-image-zoom-input" style="width: 100px;">
                    <br>
                </div>
                <input id="avatar64base1" type="hidden" value=""  name="avatar">
            </div>
        </div>

        <div class="row margin-bottom-20">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="user name">User Name</label>
                    <input class="form-control input-sm" name="name" type="text" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="user name">Companies</label>
                    <select class="form-control input-sm company-id-selector" name="company_id" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}"<?php if($user->company_id == $company->id) { echo 'selected';} ?> >{{ $company->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user name">User Role</label>
                    <select class="form-control input-sm company-id-selector" name="role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" <?php if($user->role_id == $role->id) { echo 'selected';} ?> >{{ $role->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row margin-bottom-20">
            <div class="col-md-12">
                <div class="form-group margin-bottom-20">
                    <input type="checkbox" class="checkbox" id="status" name="status" <?php if ($user->status == 1) { echo 'checked'; } ?> />
                    <label for="status" class="label-checkbox">
                        <span></span>
                        Status
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom-20">
                    <input type="checkbox" class="checkbox" id="csv" name="csv" <?php if ($user->csv == 1) { echo 'checked'; } ?> />
                    <label for="csv" class="label-checkbox">
                        <span></span>
                        CSV
                    </label>
                </div>
            </div>
        </div>

        <button id="save_btn" class="btn btn-primary btn-sm">Save</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
        {!! Form::close() !!}

    </div>
@endsection

@push('scripts')

    <script>
        $('.image-editor').cropit({
            smallImage: 'allow',
            allowDragNDrop: false,
            imageBackground: false,
            imageBackgroundBorderWidth: 20,
            imageState: {
                src: ''+"<?php if($user->avatar){
                    echo \Illuminate\Support\Facades\Storage::disk('local')->url($user->avatar);
                }  ?>"+'',
            }
        });

        $('#save_btn').click(function() {
            var imageData = $('#export_crop1').parent().cropit('export', {
                type: 'image/jpeg',
                quality: 0.9,
            });
            $('#avatar64base1').val(imageData);
        });
    </script>

@endpush