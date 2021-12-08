@extends('adminlte::page')

@section('title', 'VisitSys')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Sucesso',
  showConfirmButton: false,
  timer: 1500
})
</script>
@stop
