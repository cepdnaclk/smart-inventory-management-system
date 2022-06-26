@extends('frontend.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Edit Station</div>
  <div class="card-body">
      
      <form action="{{ url('addstation/' .$stations->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$stations->id}}" id="id" />
        <label>Station Name</label></br>
        <input type="text" name="stationName" id="stationName" value="{{$stations->stationName}}" class="form-control"></br>
        <label>Description</label></br>
        <input type="text" name="description" id="description" value="{{$stations->description}}" class="form-control"></br>
        <label>Thumb</label></br>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="thumb" id="thumb" value="{{$stations->thumb}}" class="custom-file-input">
            <label class="custom-file-label"></label>
          </div>
        </div>
      </br>
        <label>Capacity</label></br>
        <input type="text" name="capacity" id="capacity" value="{{$stations->capacity}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@stop