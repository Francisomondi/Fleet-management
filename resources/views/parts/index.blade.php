@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageStock')
                <a href="{{ route('parts.create')}}" class="btn btn-success">@lang('fleet.addParts')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.OEM')</th>
      <th>@lang('fleet.brandRef')</th>
      <th>@lang('fleet.brand')</th>
      <th>@lang('fleet.volume')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->name}}</td>
      <td>{{$row->oem}}</td>
      <td>{{$row->tp_ref}}</td>
      <td>{{$row->brand}}</td>

      <td>{{$row->stock}}</td>


      <td>


            {!! Form::open(['url' => 'parts/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

<a href="{{ url("parts/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.editParts')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" type="submit" data-toggle="tooltip"  title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
         <a href="{{ url("stock/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.inventory')"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
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
