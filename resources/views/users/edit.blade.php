@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.editUser')

                </div>

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

<?php
$names = explode(" ", $data->name);
?>

{!! Form::open(['route' => ['users.update',$data->id],'files'=>true,'method'=>'PATCH']) !!}
{!! Form::hidden('id',$data->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label']) !!}
 {!! Form::text('first_name', $names[0],['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label']) !!}
 {!! Form::text('last_name', $names[1],['class' => 'form-control','required']) !!}
 </div>

 </div>
<div class="col-md-6">
<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label']) !!}
 {!! Form::email('email', $data->email,['class' => 'form-control','required']) !!}
 </div>


</div>


<div class="col-md-12">
{!! Form::submit(__('fleet.updateUser'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
