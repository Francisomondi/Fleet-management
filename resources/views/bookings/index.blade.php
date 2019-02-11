@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manage_bookings')
                <a href="{{route("bookings.create")}}" class="btn btn-success">@lang('fleet.new_booking')</a>
                </div>

                <div class="panel-body">
<table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.customer')</th>
      <th>@lang('fleet.vehicle')</th>
      <th>@lang('fleet.pickup_time')</th>
      <th>@lang('fleet.from_date')</th>
      <th>@lang('fleet.to_date')</th>
      <th>@lang('fleet.passengers')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->customer->name}}</td>
      <td>{{$row->vehicle->make}} - {{$row->vehicle->model}} - {{$row->vehicle->license_plate}}</td>
      <td>{{$row->pickup_time}}</td>
      <td>{{$row->from_date}}</td>
      <td>{{$row->to_date}}</td>
      <td>{{$row->travellers}}</td>

      <td>


            {!! Form::open(['url' => 'bookings/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" data-toggle="tooltip"  title="@lang('fleet.delete')" type="submit"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span> </button>

        <a href="{{ url('bookings/'.$row->id.'/edit')}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit')"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a>
        @if($row->status==0)
        <a href="{{ url('bookings/complete/'.$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.complete')"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></a>
        @else
        <a data-toggle="modal" data-target="#receiptModal" href="{{ url('bookings/receipt/'.$row->id)}}" class="btn btn-info" data-toggle="tooltip"  title="@lang('fleet.receipt')"><span aria-hidden="true" class="glyphicon glyphicon-list"></span></a>
        @endif
        {!! Form::close() !!}
      </td>

    </tr>
  @endforeach

  </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section("script")
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').DataTable();
} );</script>
@endsection