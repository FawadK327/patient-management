@extends('backend.layouts.app')

@section('title', 'Prescription')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'prescription.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.prescription.partials.form', ['header' => 'Create a prescription'])
            {{ Form::close() }}
        </div>
    </section>
@stop