@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.editProfile')

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

{!! Form::open(['route' => ['drivers.update',$data->id],'files'=>true,'method'=>'PATCH']) !!}
{!! Form::hidden('id',$data->id) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label']) !!}
 {!! Form::text('first_name', $data->get_detail->first_name,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label']) !!}
 {!! Form::text('last_name', $data->get_detail->last_name,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']) !!}
 {!! Form::text('middle_name', $data->get_detail->middle_name,['class' => 'form-control']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('address', __('fleet.address'), ['class' => 'form-label']) !!}
 {!! Form::text('address', $data->get_detail->address,['class' => 'form-control','required']) !!}
 </div>


 <div class="form-group">
 {!! Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']) !!}
 <a href="{{ asset('uploads/'.$data->get_detail->profile_image) }}">View</a>
 {!! Form::file('driver_image',null,['class' => 'form-control','required']) !!}
 </div>



</div>


<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('phone', __('fleet.phoneNumer'), ['class' => 'form-label']) !!}
 {!! Form::text('phone', $data->get_detail->phone,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('license_number', __('fleet.licenseNumber'), ['class' => 'form-label']) !!}
 {!! Form::text('license_number', $data->get_detail->license_number,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('issue_date', __('fleet.issueDate'), ['class' => 'form-label']) !!}
 {!! Form::date('issue_date', $data->get_detail->issue_date,['class' => 'form-control','required','disabled']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('exp_date', __('fleet.expirationDate'), ['class' => 'form-label']) !!}
 {!! Form::text('exp_date', $data->get_detail->exp_date,['class' => 'form-control','required']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']) !!}
 <a href="{{ asset('uploads/'.$data->get_detail->license_image) }}">View</a>
 {!! Form::file('license_image',null,['class' => 'form-control','required']) !!}
 </div>


</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.editProfile'), ['class' => 'btn btn-warning']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
