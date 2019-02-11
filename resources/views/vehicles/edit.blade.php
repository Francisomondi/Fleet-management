@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                @lang('fleet.edit_vehicle')

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

{!! Form::open(['route' => ['vehicles.update',$data->id],'method'=>'PATCH']) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}

{!! Form::hidden('id',$data->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('make', __('fleet.make'), ['class' => 'form-label']) !!}
 {!! Form::text('make', $data->make,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('model', __('fleet.model'), ['class' => 'form-label']) !!}
 {!! Form::text('model', $data->model,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('type', __('fleet.type'), ['class' => 'form-label']) !!}
 {!! Form::text('type', $data->type,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('year', __('fleet.year'), ['class' => 'form-label']) !!}
 {!! Form::number('year', $data->year,['class' => 'form-control','required']) !!}
 </div>



  <div class="form-group">
 {!! Form::label('int_mileage', __('fleet.intMileage'), ['class' => 'form-label']) !!}
 {!! Form::text('int_mileage', $data->mileage,['class' => 'form-control','required']) !!}
 </div>

</div>


<div class="col-md-6">
<div class="form-group">
 {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'form-label']) !!}

  {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],$data->engine_type,['class' => 'form-control','required']) !!}
 </div>
 <div class="form-group">
 {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'form-label']) !!}
 {!! Form::text('horse_power', $data->horse_power,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('color', __('fleet.color'), ['class' => 'form-label']) !!}
 {!! Form::text('color', $data->color,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('vin', __('fleet.vin'), ['class' => 'form-label']) !!}
 {!! Form::text('vin', $data->vin,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'form-label']) !!}
 {!! Form::text('license_plate', $data->license_plate,['class' => 'form-control','required']) !!}
 </div>



</div>
<div class="col-md-6">
{!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}

</div>
<div class="col-md-6">
  <div class="form-group">
 {!! Form::label('in_service', __('fleet.service'), ['class' => 'form-label']) !!}
 {!! Form::checkbox('in_service', '1', $data->in_service,['class'=>'form-check-input']) !!}
 </div>

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
