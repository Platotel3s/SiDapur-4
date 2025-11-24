@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<p>ini {{Auth::user()->role}}</p>
@endsection
