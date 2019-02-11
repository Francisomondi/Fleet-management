@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageStock') : <strong>{{$part->name}}</strong>
                <a href="{{ url("stock/add/".$part->id)}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.cost')</th>
      <th>@lang('fleet.price')</th>
      <th>@lang('fleet.quantity')</th>
      <th>@lang('fleet.created')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->get_part->name}}</td>
      <td>{{$row->price_eur}}</td>
      <td>{{$row->price_local}}</td>
      <td>{{$row->volume}}</td>
      <td>{{$row->created_at}}</td>



      <td>


            {!! Form::open(['url' => 'stock/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}


        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

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
