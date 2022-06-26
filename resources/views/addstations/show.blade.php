@extends('frontend.layouts.app')

@section('content')
 

<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <h5 class="card-title">Station Name : {{ $stations->stationName }}</h5>
        <p class="card-text">Description : {{ $stations->description }}</p>
        <p class="card-text">Thumb : {{ $stations->thumb }}</p>
        <p class="card-text">Capacity : {{ $stations->capacity }}</p>
  </div>
       
    </hr>
  
  </div>
</div>

@stop