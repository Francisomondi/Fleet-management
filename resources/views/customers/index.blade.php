@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manage_customers')
                <a href="{{route("customers.create")}}" class="btn btn-success">@lang('fleet.add_new')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.phone')</th>
      <th>@lang('fleet.address1')</th>
      <th>@lang('fleet.city')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->phone}}</td>
      <td>{{$row->address1}}</td>
      <td>{{$row->city}}</td>

      <td>


            {!! Form::open(['url' => 'customers/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

<a href="{{ url("/customers/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit')">@lang('fleet.edit')</a>
        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" data-toggle="tooltip"  title="@lang('fleet.delete')" type="submit">@lang('fleet.delete')</button>
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
@endsection

@section("script")
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').DataTable();
} );</script>
@endsection