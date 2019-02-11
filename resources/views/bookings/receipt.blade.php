<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">@lang('fleet.receipt') #{{ $i->income_id }}</h4>

            </div>
            <div class="modal-body">
            <table class="table">
            <tr>
            <th>@lang('fleet.amount')</th>
            <td>{{ $info->amount }}</td>
            </tr>
             <tr>
            <th>@lang('fleet.mileage')</th>
            <td>{{ $info->mileage }}</td>
            </tr>
            <tr>
            <th>@lang('fleet.date')</th>
            <td>{{ $info->date }}</td>
            </tr>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>

            </div>