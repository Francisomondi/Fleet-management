@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('vehicles.add') @lang('vehicles.acquisitionType')

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

{!! Form::open(['route' => 'acq.store','method'=>'post']) !!}

 <div class="form-group">
 {!! Form::label('name', __('vehicles.name'), ['class' => 'form-label']) !!}
 {!! Form::text('name', null,['class' => 'form-control','required']) !!}
 </div>


<div class="form-group">
{!! Form::submit(__('vehicles.save'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection
