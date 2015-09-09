@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('message::message.name') !!} <small> {!! trans('cms.manage') !!} {!! trans('message::message.names') !!}</small>
@stop

@section('title')
{!! trans('message::message.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! URL::to('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('cms.home') !!} </a></li>
    <li class="active">{!! trans('message::message.names') !!}</li>
</ol>
@stop

@section('entry')
<div class="box box-warning" id='entry-message'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="main-list" class="table table-striped table-bordered">
    <thead>
        <th>{!! trans('message::message.label.subject')!!}</th>
<th>{!! trans('message::message.label.read')!!}</th>
    </thead>
</table>
@stop
@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    $('#entry-message').load('{{URL::to('admin/message/message/0')}}');
    oTable = $('#main-list').dataTable( {
        "ajax": '{{ URL::to('/admin/message/message/list') }}',
        "columns": [
        { "data": "subject" },
{ "data": "read" },],
        "messageLength": 50
    });

    $('#main-list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass("selected").siblings(".selected").removeClass("selected");

        var d = $('#main-list').DataTable().row( this ).data();

        $('#entry-message').load('{{URL::to('admin/message/message')}}' + '/' + d.id);

    });
});
</script>
@stop

@section('style')
@stop