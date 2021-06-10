@extends('Admin.admin')

@section('style')
    <link href="{{ asset('css/calendario/fullcalendar.css') }}" rel='stylesheet' />
	<link href="{{ asset('css/calendario/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
	<link href="{{ asset('css/calendario/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container cont">
    <div id=''>
        <div id='calendar'></div>
        <div style='clear:both'></div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/calendario/jquery-1.10.2.js') }}" defer></script>
    <script src="{{ asset('js/calendario/jquery-ui.custom.min.js') }}" defer></script>
    <script src="{{ asset('js/calendario/fullcalendar.js') }}" defer></script>
    <script src="{{ asset('js/calendario/script_admin.js') }}" defer></script>
@endsection