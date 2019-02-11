@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('vehicles.acquisitionCategories')
                <a href="{{ route('acq.create')}}" class="btn btn-success">@lang('vehicles.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('vehicles.name')</th>
      <th>@lang('vehicles.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
      <td>{{$row->name}}</td>

      <th>


            {!! Form::open(['url' => 'acq/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

<a href="{{ url("acq/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('vehicles.edit')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" type="submit" data-toggle="tooltip"  title="@lang('vehicles.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
