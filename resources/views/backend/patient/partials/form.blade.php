<div class="row">
    <div class="col-md-12">
        @include('partials.errors')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-head">
                <header>{!! $header !!}</header>
                <div class="tools visible-xs">
                    <a class="btn btn-default btn-ink" onclick="history.go(-1);return false;">
                        <i class="md md-arrow-back"></i>
                        Back
                    </a>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    <input type="submit" name="publish" class="btn btn-primary ink-reaction" value="Publish">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input type="text" name="name" id="patient_name" class="form-control" required value="{{ @$patient->name }}">
                            <!-- {{ Form::text('name',old('name'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('name','Name*') }} -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address"> Address* </label>
                            <input type="text" name="address" id="patient_address" class="form-control" required value="{{ @$patient->address }}">
                            <!-- {{ Form::text('address',old('address'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('address','Address*') }} -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="phone"> Phone* </label>
                            <input type="text" name="phone" id="patient_phone" class="form-control" required value="{{ @$patient->phone }}">
                            <!-- {{ Form::text('phone',old('phone'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('phone','Phone No.*') }} -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="age"> Age* </label>
                            <input type="text" name="age" id="patient_age" class="form-control" required value="{{ @$patient->age }}">
                            <!-- {{ Form::number('age',old('age'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('age','Age*') }} -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="name"> Gender* </label>
                        <select class="form-control selectpicker" data-live-search="true" name="gender" id="patient_gender">
                            <option value="Male" @if(@$patient && @$patient->gender == 'Male') selected @else '' @endif >Male</option>
                            <option value="Female" @if(@$patient && @$patient->gender == 'Female') selected @else '' @endif>Female</option>
                            <option value="Others" @if(@$patient && @$patient->gender == 'Other') selected @else '' @endif>Other</option>
                        </select>
                            <!-- {{ Form::select('gender', array('Male'=>'Male', 'Female'=>'Female', 'Others'=>'Others'), old('gender'), ['class' => 'form-control gender', 'required']) }}
                            {{ Form::label('gender','Gender*') }} -->
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <label class="text-default-light">Featured Image (Optional)</label>
                        @if(isset($patient) && $patient->image)
                        abc
                            <input type="file" name="image" class="dropify"/>
                            <img src="{{  asset('storage/'.$patient->image->path) }}" alt="">
                            <!-- <input type="file" name="image" class="dropify" data-default-file="{{ asset($patient->image->thumbnail(260,198)) }}"/> -->
                        @else
                            <input type="file" name="image" class="dropify"/>
                        @endif
                    </div>
                </div> --}}
                <div class="card-actionbar">
                    <div class="card-actionbar-row">
                        <button type="reset" class="btn btn-default ink-reaction">Reset</button>
                        <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-affix affix-4">
            <div class="card-head">
                <div class="tools">
                    <a class="btn btn-default btn-ink" href="{{ route('patient.index') }}">
                        <i class="md md-arrow-back"></i>
                        Back
                    </a>
                </div>
            </div>
            {{ Form::hidden('view', old('view')) }}
        </div>
    </div>
</div>

@push('styles')
<link href="{{ asset('backend/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-select.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('backend/js/libs/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/backend/js/bootstrap-select.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor', {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
</script>
@endpush