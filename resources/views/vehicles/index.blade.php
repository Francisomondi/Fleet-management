@extends("layouts.app")

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageVehicles')
                <a href="{{ route('vehicles.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.make')</th>
      <th>@lang('fleet.model')</th>
      <th>@lang('fleet.type')</th>
      <th>@lang('fleet.engine')</th>
      <th>@lang('fleet.color')</th>
      <th>@lang('fleet.licensePlate')</th>
      <th>@lang('fleet.intMileage')</th>
      <th>@lang('fleet.service')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
		<td>{{$row->make}}</td>
		<td>{{$row->model}}</td>
		<td>{{$row->type}}</td>
		<td>{{$row->engine_type}}</td>
		<td>{{$row->color}}</td>
		<td>{{$row->license_plate}}</td>
		<td>{{$row->int_mileage}}</td>
		<td>{{($row->in_service)?"YES":"NO"}}</td>
      <td>

            {!! Form::open(['url' => 'vehicles/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

          <a href="{{ url("vehicles/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit_vehicle')">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          <input type="hidden" name="id" value="{{ $row->id }}">
          <button class="btn btn-danger" type="submit" data-toggle="tooltip"  title="@lang('fleet.delete_vehicle')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
           <a href="{{ url("acquisition/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.vehicle_acq')">
          <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
          </a>
           <?php if ($row->in_service) {?>
              <a href="{{ url("drivers/assign/".$row->id)}}" class="btn btn-primary" data-toggle="tooltip"  title="@lang('fleet.assign_driver')">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          </a>
      <?php }?>
        {!! Form::close() !!}
      </td>

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
