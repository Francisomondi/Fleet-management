@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.search')</div>
                    <div class="panel-body">
                       {!! Form::open(['url' => 'searchparts/search','method'=>'post']) !!}
                         <div class="col-md-6">
                         <div class="form-group">
                         {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
                         {!! Form::text('name', null,['class' => 'form-control']) !!}
                         </div>

                          <div class="form-group">
                         {!! Form::label('oem', __('fleet.OEM'), ['class' => 'form-label']) !!}
                         {!! Form::text('oem', null,['class' => 'form-control']) !!}
                         </div>



                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                         {!! Form::label('brand', __('fleet.brand'), ['class' => 'form-label']) !!}
                         {!! Form::text('brand', null,['class' => 'form-control']) !!}
                         </div>


                        </div>
                        <div class="col-md-12">
                        {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}

                        </div>
                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
