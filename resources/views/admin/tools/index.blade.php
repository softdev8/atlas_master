@extends('layouts.admin')

@section('content')
    <div class="breadcrumb-block ">
        <div class="breadcrumb-element">
            <ol class="breadcrumb">
                <li class="breadcrumb-active">
                    <a href="/admin">AdminPanel</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div data-pages="card" class="card card-default" id="card-basic">
                <div class="card-header  ">
                    <div class="card-title">Import Tools</div>
                </div>
                <div class="card-block">
                    <h3><span class="semi-bold">Candidates</span> import</h3>
                    <p>Import Exsel file with candidates to DB</p>
                    {!! Form::open(['route' => 'admin.import.candidates', 'files'=> true, 'method' => 'POST']) !!}
                        @csrf
                        <div class="controls clearfix margin-top-20">
                                 <span class="btn btn-success btn-file btn-sm">
                                        <i class="icon-plus"></i> <span>Choose file...</span>
                                        <input type="file" name="candidates" id="candidates" />
                                 </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm margin-top-20">
                            {{ __('Submit') }}
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        {{--
        <div class="col-md-4">
            <div data-pages="card" class="card card-default background-warning" id="card-basic">
                <div class="card-header  ">
                    <div class="card-title">Import Tools</div>
                </div>
                <div class="card-block">
                    <h3><span class="semi-bold">Firm</span> import</h3>
                    <p>Import Exsel file with firms to DB</p>
                    <form>
                        <div class="controls clearfix margin-top-20">
                                 <span class="btn btn-success btn-file btn-sm">
                                        <i class="icon-plus"></i> <span>Choose file...</span>
                                        <input type="file" name="image" id="image" disabled/>
                                 </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm margin-top-20" disabled>
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div data-pages="card" class="card card-default background-warning" id="card-basic" >
                <div class="card-header  ">
                    <div class="card-title">Import Tools</div>
                </div>
                <div class="card-block">
                    <h3><span class="semi-bold">Firm Locations</span> import</h3>
                    <p>Import Exsel file with salaries to DB</p>
                    <form>
                        <div class="controls clearfix margin-top-20">
                                 <span class="btn btn-success btn-file btn-sm">
                                        <i class="icon-plus"></i> <span>Choose file...</span>
                                        <input type="file" name="image" id="image" disabled />
                                 </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm margin-top-20" disabled>
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        --}}
    </div>
    {{--<div class="row">
        <div class="col-md-4">
            <div data-pages="card" class="card card-default background-warning" id="card-basic">
                <div class="card-header  ">
                    <div class="card-title">Import Tools</div>
                </div>
                <div class="card-block">
                    <h3><span class="semi-bold">Firm salaries</span> import</h3>
                    <p>Import Exsel file with salaries to DB</p>
                    <form>
                        <div class="controls clearfix margin-top-20">
                                 <span class="btn btn-success btn-file btn-sm">
                                        <i class="icon-plus"></i> <span>Choose file...</span>
                                        <input type="file" name="image" id="image" disabled/>
                                 </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm margin-top-20" disabled>
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>--}}

@endsection


@push('styles')



@endpush

@push('scripts')
    <script>
        $('.btn-file').each(function (){
            var self = this;
            $('input[type=file]', this).change(function (){
                // remove existing file info
                $(self).next().remove();
                // get value
                var value = $(this).val();
                // get file name
                var fileName = value.substring(value.lastIndexOf('/')+1);
                // get file extension
                var fileExt = fileName.split('.').pop().toLowerCase();
                // append file info
                $('<span><i class="icon-file icon-' + fileExt + '"></i> ' + fileName + '</span>').insertAfter(self);
            });
        });
    </script>
@endpush