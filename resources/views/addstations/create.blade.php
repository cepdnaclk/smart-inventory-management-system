@extends('frontend.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
      
      <form action="{{ url('addstation') }}" method="post">
        {!! csrf_field() !!}
        <label>Station Name</label></br>
        <input type="text" name="stationName" id="stationName" class="form-control"></br>
        <label>Description</label></br>
        <input type="text" name="description" id="description" class="form-control"></br>
        <label>Thumb</label></br>
        <input type="text" name="thumb" id="thumb" class="form-control"></br>
        <label>Capacity</label></br>
        <input type="text" name="capacity" id="capacity" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@stop