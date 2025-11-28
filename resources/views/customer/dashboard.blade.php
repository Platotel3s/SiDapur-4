@extends('layouts.app')

@section('title', 'Customer Panel')

@section('content')
<div class="flex flex-col gap-6">

    <div class="rounded-xl shadow p-6">
        <div class="grid gap-4 sm:grid-cols-2">
            @include('customer.products.index')
        </div>
    </div>
</div>
@endsection
