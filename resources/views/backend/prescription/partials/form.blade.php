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
                            <label class="text-default-light">Patient: </label>
                            <select name="patient_id" id="patient_ids" class="form-control selectpicker" data-live-search="true" required>
                                <option disabled>Please select </option> 
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" @if(@$prescription && @$prescription->patient_id == $patient->id || @$selected_patient == $patient->id) selected  @else '' @endif>{{ $patient->name }}</option>
                                @endforeach    
                            </select>
                        </div>
                        <!-- <div class="col-sm-10">
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <!-- <input type="file" name="image" class="dropify"/> -->
                            <label class="text-default-light">Date: </label>
                            <input class="form-control" type="date" id="prescription_date" name="prescription_date" value="{{ @$prescription->date }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="text-default-light">Description: </label>
                            <textarea name="description" id="presc_description" cols="100" rows="10"> {{ @$prescription->discription }} </textarea>
                        </div>
                    </div>
                </div>
                
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
                    <a class="btn btn-default btn-ink" href="{{ route('prescription.index') }}">
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
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
        // var data = "{!! @$prescription->description !!}";
        // console.log('Description ======> ', data);
        ClassicEditor
        .create( document.querySelector( '#presc_description' ) )
        .then(function (editor) {
            editor.setData('{!! @$prescription->description !!}');
        })
        .catch( error => {
            console.error( error );
        } );

        // ClassicEditor.instances['presc_description'].setData(data);
    // CKEDITOR.replace('my-editor', {
    //     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    //     filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    //     filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    //     filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    // });
</script>
@endpush