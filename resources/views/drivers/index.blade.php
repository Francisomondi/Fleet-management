@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>@lang('menu.drivers')</strong>
                <a href="{{ route('drivers.create')}}" class="btn btn-success">@lang('fleet.addDriver')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.is_active')</th>
      <th>@lang('fleet.phone')</th>
      <th>@lang('fleet.start_date')</th>

      <th>Action</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{($row->get_detail->is_active) ? "YES" : "NO"}}</td>
      <td>{{$row->get_detail->phone}}</td>
      <td>{{$row->get_detail->start_date}}</td>
      <th>


            {!! Form::open(['url' => 'drivers/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}
<a href="{{ url("/changepass/".$row->id)}}" class="btn btn-info" data-toggle="tooltip"  title="@lang('fleet.change_password')"><i class="fa fa-key"  aria-hidden="true"></i></a>
<a href="{{ url("drivers/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit_driver')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
@if($row->get_detail->is_active)
<a href="{{ url("drivers/disable/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.disable_driver')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
@else
<a href="{{ url("drivers/enable/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.enable_driver')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
@endif

        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" type="submit" data-toggle="tooltip"  title="@lang('fleet.delete_driver')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
        {!! Form::close() !!}
      </th>

    </tr>
  @endforeach



  </tbody>
  </table>
  {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
