@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageUsers')
                <a href="{{route("users.create")}}" class="btn btn-success">@lang('fleet.addUser')</a>
                </div>

                <div class="panel-body">
                    <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.created')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <th>{{$row->id}}</th>
      <th>{{$row->name}}</th>
      <th>{{$row->email}}</th>
      <th>{{$row->created_at}}</th>
      <th>


            {!! Form::open(['url' => 'users/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}
<a href="{{ url("/changepass/".$row->id)}}" data-toggle="tooltip"  title="@lang('fleet.changePassword')" class="btn btn-info">@lang('fleet.change_password')</a>
<a href="{{ url("/users/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="Edit User">@lang('fleet.editProfile')</a>
        <input type="hidden" name="id" value="{{ $row->id }}">
        <button class="btn btn-danger" data-toggle="tooltip"  title="@lang('fleet.deleteUser')" type="submit">@lang('fleet.deleteUser')</button>
        {!! Form::close() !!}
      </th>

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
