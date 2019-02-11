@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('vehicles.acquisition') :
                <strong>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->license_plate }}</strong>
                </div>
                   <div class="panel-body">

                      @if (Session::has('status'))
                      <ul>
                      <span class="help-block">
        {!! session('status') !!}
        </span>
        </ul>
   @endif

                      {!! Form::open(['route' => 'acquisition.store','method'=>'post']) !!}

                    {!! Form::hidden('user_id',Auth::user()->id) !!}

                     {!! Form::hidden('vehicle_id',$vehicle_id)  !!}

                     <div class="row">
                     <div class="col-md-12">
                       <table class="table">
                         <thead>
                         <th>@lang('vehicles.expenseType')</th>
                         <th>@lang('vehicles.expenseAmount')</th>
                         <th>Action</th>
                         </thead>
                         <tbody id="hvk">
<?php
if (!empty($data)):
	$rows = unserialize($data->details);
	if ($rows) {
		foreach ($rows[0] as $key => $val):
		?>
																											<tr>

																										  <td>
																									    <select name="field_type[]" class="form-control"  required>
																									          @foreach($cats as $cat)
																									      <option value="{{$cat->name}}" {{ ($cat->name==$key)? "selected" : "" }}>{{$cat->name}}</option>
																									      @endforeach
																									    </select>
																									    </td>
																											<td><input type="number" name="field_value[]" value="{{$val}}" class="form-control" /></td>
																											<td><button type="button"  class="btn btn-danger del_btn" >@lang('fleet.delete')</button></td>
																											</tr>
																											<?php endforeach;
}
endif;
?>
                         </tbody>
                       </table>
                     </div>

                     </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                             {!! Form::submit(__('vehicles.update'), ['class' => 'btn btn-default']) !!}
                             {!! Form::button(__('vehicles.addNew'), ['class'=>'btn btn-info','id'=>"add_new"])!!}
                          </div>
                        </div>
                     </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section("script")
<script type="text/javascript">
  $(function(){
    $("#add_new").on("click",function(){
      var new_row='<tr>';
      new_row+='<td><select name="field_type[]" class="form-control"  required>';
      @foreach($cats as $cat)
      new_row+='<option value="{{$cat->name}}">{{$cat->name}}</option>';
      @endforeach
      new_row+='</select></td>';
      new_row+='<td><input type="number" name="field_value[]" class="form-control" /></td>';
      new_row+='<td><button type="button"  class="btn btn-danger del_btn" >@lang('fleet.delete')</button></td>';
      new_row+='</tr>';
      $("#hvk").append(new_row);

    });

  });
   $(document).on("click",".del_btn",function(){
      $(this).parent().parent().remove();
    });
</script>
@endsection