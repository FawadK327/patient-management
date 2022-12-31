@extends('backend.layouts.app')

@section('title', 'Prescription')
@section('content')
    <style>
        .table td {
            white-space: break-spaces !important;
            width: 25% !important;
        }
        .actions{
            white-space: nowrap !important;
        }
        .prescription-details{
            max-height: 150px !important;
            overflow-y: auto !important;
        }
    </style>
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All prescriptions</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('prescription.create') }}">
                            <i class="md md-add"></i>
                            Add Prescription
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-hover" id="prescription-datatable">
                            <thead>
                            <tr>
                                <th>{{ strtoupper(__('Patient name')) }}</th>
                                <th>{{ strtoupper(__('dated')) }}</th>
                                <th>{{ strtoupper(__('Description')) }}</th>
                                <!-- <th>{{ strtoupper(__('age')) }}</th>
                                <th>{{ strtoupper(__('gender')) }}</th> -->
                                <th>{{ strtoupper(__('action')) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#prescription-datatable').DataTable({
            "dom": "rBftip",
            "language": {
                "processing": "<h2 id='dt_loading'><span class='fa fa - spinner fa-pulse'></span> Loading...</h2>"
            },
            "buttons": [
                'pageLength', 'colvis'
            ],
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "POST",
                "data": {"_token": '{{ csrf_token() }}'},
                "url": '{{ route('prescription.datatable') }}'
            },
            "pageLength": "25",
            "aoColumns": [
                {data: "patient_name", name: "patient_name", searchable: "false"},
                {data: "date", name: "date" },
                {data: "description", name: "description"},
                {data: "action", name: "action"},
                
            ]
        });
    });
</script>
@endpush