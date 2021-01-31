@extends('layouts.mainDiyor')
@section('content')
    <div class="container-fluid p-5">
        <div class="col-md-12 px-0 table-box">
<div class="container">
    {!! Form::open(['route' => 'announcements.store','method' => 'post','files'=>true]) !!}
    @include('admin.announcements._form')
    <button type="submit" class="btn adding-button ml-3">Saqlash</button>
    {!! Form::close() !!}
</div>
        </div>
    </div>
@endsection