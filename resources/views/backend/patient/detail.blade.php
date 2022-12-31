@extends('backend.layouts.app')

@section('title', 'Patient')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="Card-head text-center">
                    <h1>Patient Details</h1>
                </div>
                <div class="card-body">
                    <div class="text-center card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Username</p>
                                </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->username }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Contact</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Address</p>
                            </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $patient->address }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">age</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $patient->age }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Gender</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $patient->gender }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section>
        <div class="section-body" style="margin-top:10px !important;">
            <div class="card" style=" border-radius:50px !important; margin-bottom:0px !important;">
                <div class="col-12">
                    <div class="card-head col-md-6">
                        <h3>PRESCRIPTIONS</h3>
                    </div>
                    <div class="col-md-6 card-head text-right">
                        <a class="btn btn-primary ink-reaction" href="{{ url('prescription/create?id='.$patient->id) }}">
                            <i class="md md-add"></i>
                            Add Prescription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>        
    @foreach($patient->prescriptions as $prescription)
        <section>
            <div class="section-body" style="margin-top:10px !important;">
    
                <div class="card" style="margin-bottom:0px !important;">
                    <div class="Card-head text-center">
                        <h1>Dated: {{date_format(new DateTime($prescription->date),"dS-M-Y") }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="text-center card">
                            <div class="card-body">
                                <div class="row">
                                    {!! $prescription->description !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach    
@stop

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endpush


@push('scripts')

@endpush