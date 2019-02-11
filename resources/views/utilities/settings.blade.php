@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 ">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.change_settings')</div>
<div class="panel-body">


{!! Form::open(['route' => 'settings.store','method'=>'post']) !!}
@foreach($settings as $setting)

<div class="form-group col-md-6">
{!! Form::label($setting->name,__('fleet.'.$setting->name),['class'=>"form-label"]) !!}
@if($setting->name=="language")

{!! Form::select('name['.$setting->name.']', ['en' => 'English', 'de' => 'German', 'es' => 'Spanish', 'fr' => 'French', 'pt' => 'Portuguese'], Hyvikk::get("language"),['class'=>"form-control"]) !!}
@else


{!! Form::text('name['.$setting->name.']',$setting->value,['class'=>"form-control"]) !!}


@endif
</div>
@endforeach
<div class="form-group">

<input type="submit"  class="form-control btn btn-primary"  value="@lang('fleet.save')" />
</div>
{!! Form::close()!!}

</div>
</div>
</div>
</div>
</div>
@endsection