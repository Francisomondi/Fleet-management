@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.new_booking')

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

{!! Form::open(['route' => 'bookings.store','method'=>'post']) !!}
{!! Form::hidden('user_id',Auth::user()->id)!!}
{!! Form::hidden('status',0)!!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('customer_id',__('fleet.selectCustomer'), ['class' => 'form-label']) !!}
<a href="{{ route('customers.create')}}" target="_blank">@lang('fleet.new_customer')</a>
 <select id="customer_id" name="customer_id" class="form-control xxhvk" required>
<option value="">-</option>
@foreach($customers as $customer)
<option value="{{$customer->id}}">{{$customer->name}}</option>
@endforeach
 </select>
 </div>

 </div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']) !!}
  <select id="vehicle_id" name="vehicle_id" class="form-control xxhvk" required>
<option value="">-</option>
@foreach($vehicles as $vehicle)
<option value="{{$vehicle->id}}">{{$vehicle->make}} {{$vehicle->model}} - {{$vehicle->color}} - {{$vehicle->license_plate}}</option>
@endforeach
 </select>
 </div>


</div>



<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('travellers',__('fleet.no_travellers'), ['class' => 'form-label']) !!}
 {!! Form::number('travellers',1,['class'=>'form-control','min'=>1]) !!}
 </div>


</div>


<div class="col-md-4">
  <div class="form-group">
{!! Form::label('from_date',__('fleet.from_date'), ['class' => 'form-label']) !!}
<div class='input-group date' id='from_date'>
{!! Form::text('from_date',date("Y-m-d"),['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
{!! Form::label('to_date',__('fleet.to_date'), ['class' => 'form-label']) !!}
<div class='input-group date' id='to_date'>
{!! Form::text('to_date',null,['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
  </div>
  </div>
    <div class="col-md-4">
  <div class="form-group">
{!! Form::label('pickup_time',__('fleet.pickup_time'), ['class' => 'form-label']) !!}
  <div class='input-group date' id='pickup_time'>

{!! Form::text('pickup_time',null,['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
  </div>
  </div>

    <div class="col-md-6">
  <div class="form-group">


{!! Form::label('pickup_addr',__('fleet.pickup_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('pickup_addr',null,['class'=>'form-control','required']) !!}

  </div>
  </div>
    <div class="col-md-6">
  <div class="form-group">
{!! Form::label('dest_addr',__('fleet.dest_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('dest_addr',null,['class'=>'form-control','required']) !!}
  </div>
  </div>

<div class="col-md-12">
{!! Form::submit(__('fleet.save_booking'), ['class' => 'btn btn-info']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
  $(".xxhvk").select2();
  $('#from_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#to_date').datetimepicker({format: 'YYYY-MM-DD',useCurrent: false});
       $("#from_date").on("dp.change", function (e) {
            $('#to_date').data("DateTimePicker").minDate(e.date);
        });
        $("#to_date").on("dp.change", function (e) {
            $('#from_date').data("DateTimePicker").maxDate(e.date);
        });
   $('#pickup_time').datetimepicker({
  format: 'LT',

    });

});
</script>
@endsection
