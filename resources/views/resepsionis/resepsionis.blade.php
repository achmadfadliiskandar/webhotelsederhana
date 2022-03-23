@extends('template.master')

@section('title','Dashboard Resepsionis')

@section('content')
<h2>Welcome User : {{Auth::user()->name}}</h2>
<h4>As Role : {{Auth::user()->role}}</h4>
@endsection