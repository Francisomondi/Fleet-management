@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.incomeCategories')
                <a href="{{ route('incomecategories.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.incomeAmount')</th>
      <th>@lang('fleet.created')</th>
      <th>Action</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
      <td>{{$row->name}}</td>
      <td>{{$row->cost}}</td>
      <td>{{$row->created_at}}</td>
      <th>


            {!! Form::open(['url' => 'incomecategories/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

<a href="{{ url("incomecategories/".$row->id."/edit")}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
