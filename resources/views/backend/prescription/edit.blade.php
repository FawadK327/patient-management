@extends('backend.layouts.app')

@section('title', 'Prescription')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($prescription, ['route' =>['prescription.update', $prescription->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }}
            @include('backend.prescription.partials.form', ['header' => 'Edit Prescription'])
            {{ Form::close() }}
        </div>
    </section>
@stop