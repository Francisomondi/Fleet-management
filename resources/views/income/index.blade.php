@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addRecord')</div>

                <div class="panel-body">
{!! Form::open(['route' => 'income.store','method'=>'post','class'=>'form-inline']) !!}


  <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" required>
  <option value="">@lang('fleet.selectVehicle')</option>
    @foreach($vehicels as $vehicle)
    <option value="{{ $vehicle->id }}" data-mileage="{{ $vehicle->mileage}}">{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>
    @endforeach
  </select>

  <select id="income_type" name="income_type" class="form-control vehicles" required>
  <option value="">@lang('fleet.incomeType')</option>
    @foreach($types as $type)
    <option value="{{ $type->id }}" data-amount="{{ $type->cost }}">{{$type->name}}</option>
    @endforeach
  </select>
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.amount')</div>
  <input required="required" name="revenue" type="number" step="0.01" id="revenue" class="form-control">
  </div>

      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.mileage')</div>
  <input required="required" name="mileage" type="number" id="mileage" class="form-control">
  </div>



<input required="required" name="date" type="text" value="{{ date('Y-m-d')}}"  id="date" class="form-control">
  <button type="submit" class="btn btn-primary">@lang('fleet.add')</button>
</form>

                </div>
            </div>
        </div>
    </div>

<!--                      TABLE             -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.todayIncome'): <strong>{{ $total}}</strong></div>

                <div class="panel-body">
<table class="table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('vehicles.make')</th>
      <th>@lang('vehicles.model')</th>
      <th>@lang('vehicles.licensePlate')</th>
      <th>@lang('fleet.incomeType')</th>
      <th>@lang('fleet.date')</th>
      <th>@lang('fleet.amount')</th>
      <th>@lang('fleet.mileage')</th>

    </tr>
  </thead>
  <tbody>
  @foreach($today as $row)
     <tr>

      <td>{{$row->vehicle->make}}</td>

      <td>{{$row->vehicle->model}}</td>
      <td>{{$row->vehicle->license_plate}}</td>
      <td>{{$row->category->name}}</td>
      <td>{{$row->date}}</td>
      <td>{{$row->amount}}</td>
      <td>{{$row->mileage}}</td>

    </tr>
  @endforeach

  </tbody>
  </table>


                </div>

            </div>
        </div>
    </div>




</div>
@endsection


@section("script")
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".vehicles").select2();
  $("#vehicle_id").on("change",function(){
    $("#mileage").val($(this).find(':selected').data("mileage"));
    $("#mileage").attr("min",$(this).find(':selected').data("mileage"));
  });

  $("#date").datepicker({
    dateFormat:'yy-mm-dd',

  });
   $('#income_type').change(function() {

    $("#revenue").val($(this).find(':selected').data('amount'));

    });

});
</script>
@endsection
