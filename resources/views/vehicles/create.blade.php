@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addVehicle')

                </div>

                <div class="panel-body">
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{!! Form::open(['route' => 'vehicles.store','method'=>'post']) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('make', __('fleet.make'), ['class' => 'form-label']) !!}
 {!! Form::text('make', null,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('model', __('fleet.model'), ['class' => 'form-label']) !!}
 {!! Form::text('model', null,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('type', __('fleet.type'), ['class' => 'form-label']) !!}
 {!! Form::text('type', null,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('year', __('fleet.year'), ['class' => 'form-label']) !!}
 {!! Form::number('year', null,['class' => 'form-control','required']) !!}
 </div>



  <div class="form-group">
 {!! Form::label('int_mileage', __('fleet.intMileage'), ['class' => 'form-label']) !!}
 {!! Form::text('int_mileage', null,['class' => 'form-control','required']) !!}
 </div>

</div>


<div class="col-md-6">
<div class="form-group">
 {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'form-label']) !!}
 {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],null,['class' => 'form-control','required']) !!}
 </div>
 <div class="form-group">
 {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'form-label']) !!}
 {!! Form::text('horse_power', null,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('color', __('fleet.color'), ['class' => 'form-label']) !!}
 {!! Form::text('color', null,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('vin', __('fleet.vin'), ['class' => 'form-label']) !!}
 {!! Form::text('vin', null,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'form-label']) !!}
 {!! Form::text('license_plate', null,['class' => 'form-control','required']) !!}
 </div>



</div>
<div class="col-md-6">
{!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}

</div>
<div class="col-md-6">
  <div class="form-group">
 {!! Form::label('in_service', __('fleet.service'), ['class' => 'form-label']) !!}
 {!! Form::checkbox('in_service', '1', false,['class'=>'form-check-input']) !!}
 </div>

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
