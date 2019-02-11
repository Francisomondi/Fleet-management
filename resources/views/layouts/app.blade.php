<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<script>
window.Laravel = {!! json_encode([
'csrfToken' => csrf_token(),
]) !!};


</script>
</head>
<body>
<div id="app">
<nav class="navbar navbar-default navbar-static-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<img src="{{ url("/logo-40.png") }}" class="navbar-brand">
<a class="navbar-brand" href="{{ url('/') }}">

{{ Hyvikk::get('app_name') }}

</a>
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">

@if (!Auth::guest() &&  Auth::user()->user_type!="D")
<ul class="nav navbar-nav">
<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.userManagement')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("drivers.index") }}">@lang('menu.drivers')</a>
</li>
@if(Auth::user()->user_type=="S")
<li>
<a href="{{ route("users.index") }}">@lang('menu.users')</a>
</li>
@endif

</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.vehicles')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("vehicles.index") }}">@lang('menu.manageVehicles')</a>
</li>
<li>
<a href="{{ route("parts.index") }}">@lang('menu.manageParts')</a>
</li>

<li>
<a href="{{ route("expensecategories.index") }}">@lang('menu.expenseCategories')</a>
</li>
<li>
<a href="{{ route("incomecategories.index") }}">@lang('menu.incomeCategories')</a>
</li>

<li>
<a href="{{ route("acq.index") }}">@lang('menu.acquisitionCategories')</a>
</li>

</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.search')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("searchvehicles.index") }}">@lang('menu.search_vehicle')</a>
</li>
<li>
<a href="{{ route("searchparts.index") }}">@lang('menu.search_parts')</a>
</li>



</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.transactions')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("income.index")}}">@lang('menu.addIncome')</a>
</li>
<li>
<a href="{{ route("expense.index")}}">@lang('menu.addExpense')</a>
</li>

<li>
<a href="{{ route("transaction.index")}}">@lang('menu.partTransaction')</a>
</li>
</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.bookings')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li> <a href="{{ route("bookings.create")}}">@lang('menu.newbooking')</a> </li>
<li> <a href="{{ route("customers.index")}}">@lang('menu.manage_customers')</a> </li>
<li> <a href="{{ route("bookings.index")}}">@lang('menu.manage_bookings')</a> </li>

</ul>
</li>
<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.reports')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li> <a href="{{ route("reports.delinquent")}}">@lang('menu.deliquentReport')</a> </li>
<li> <a href="{{ route("reports.monthly")}}">@lang('menu.monthlyReport')</a> </li>
<li> <a href="{{ route("reports.parts")}}">@lang('menu.partsReport')</a> </li>
<li> <a href="{{ route("reports.booking")}}">@lang('menu.bookingReport')</a> </li>


</ul>
</li>
</ul>
@endif

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
<!-- Authentication Links -->
@if (!Auth::guest())
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
{{ Auth::user()->name }} <span class="caret"></span>
</a>

<ul class="dropdown-menu" role="menu">
@if(Auth::user()->user_type=="S")
<li>
<a href="{{ route("settings.index") }}">@lang('menu.settings')</a>
</li>
@endif
<li>
<a href="{{ route('changepass',array(Auth::user()->id))}}">@lang('menu.profile')</a>
</li>
<li>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
        @lang('menu.logout')
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
</ul>
</li>
@endif
</ul>
</div>
</div>
</nav>

@yield('content')
</div>
@yield('script2')
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@yield('script')
</body>
</html>