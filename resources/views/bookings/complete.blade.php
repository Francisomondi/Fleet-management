@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.add_payment')

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

{!! Form::open(['route' => 'bookings.complete','method'=>'post']) !!}
{!! Form::hidden('user_id',$data->user_id)!!}
{!! Form::hidden('customer_id',$data->customer_id)!!}
{!! Form::hidden('vehicle_id',$data->vehicle_id)!!}
{!! Form::hidden('status',1)!!}
{!! Form::hidden('booking_id',$data->id)!!}
<div class="col-md-12">
<div class="form-group">
<label class="form-label">@lang('income.incomeType')</label>
  <select id="income_type" name="income_type" class="form-control vehicles" required>
  <option value="">@lang('income.incomeType')</option>
    @foreach($types as $type)
    <option value="{{ $type->id }}">{{$type->name}}</option>
    @endforeach
  </select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label class="form-label">@lang('income.amount')</label>
{!! Form::number('revenue',1,['class'=>'form-control','min'=>1]) !!}
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="form-label">@lang('income.mileage')</label>
{!! Form::number('mileage',1,['class'=>'form-control','min'=>1]) !!}
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="form-label">@lang('income.date')</label>
{!! Form::date('date',date('Y-m-d'),['class'=>'form-control','min'=>1]) !!}
</div>
</div>





<div class="col-md-12">
{!! Form::submit(__('fleet.record'), ['class' => 'btn btn-info']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
  $(".xxhvk").select2();
   $('#datetimepicker1').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',


    });

});
</script>
@endsection
