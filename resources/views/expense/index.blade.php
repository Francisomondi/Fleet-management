@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addRecord')</div>

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
{!! Form::open(['route' => 'expense.store','method'=>'post','class'=>'form-inline']) !!}


  <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" required>
  <option value="" >@lang('fleet.selectVehicle')</option>
    @foreach($vehicels as $vehicle)
    <option value="{{ $vehicle->id }}">{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>
    @endforeach
  </select>

  <select id="expense_type" name="expense_type" class="form-control vehicles" required>
  <option value="" >@lang('fleet.expenseType')</option>
    @foreach($types as $type)
    <option value="{{ $type->id }}" data-amount="{{ $type->cost }}">{{$type->name}}</option>
    @endforeach
  </select>
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.amount')</div>
  <input required="required" name="revenue" type="number" step="0.01" id="revenue" class="form-control">
  </div>

    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.comment')</div>
  <input  name="comment" type="text" id="comment" class="form-control">
  </div>


<input  name="date" type="text"  id="date" value="{{ date('Y-m-d')}}" class="form-control">
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
                <div class="panel-heading">@lang('fleet.todayExpense') : <strong>{{ $total}}</strong></div>

                <div class="panel-body">
<table class="table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('vehicles.make')</th>
      <th>@lang('vehicles.model')</th>
      <th>@lang('vehicles.licensePlate')</th>
      <th>@lang('vehicles.expenseType')</th>
      <th>@lang('fleet.date')</th>
      <th>@lang('fleet.amount')</th>
      <th>@lang('fleet.comment')</th>

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
      <td>{{$row->comment}}</td>

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

  $("#date").datepicker({
    dateFormat:'yy-mm-dd',

  });
   $('#expense_type').change(function() {

    $("#revenue").val($(this).find(':selected').data('amount'));

    });

});
</script>
@endsection
