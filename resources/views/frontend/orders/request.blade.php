@extends('backend.layouts.app')

@section('title', __('My Order request'))
@section('content')  
<div class="container mt-4">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
<form method="POST" action="{{route('frontend.user.store.request')}}">
  @csrf  
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your Name" name="name"  value="{{old('name')}}" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="form-group">
      <label for="enumber">ENumber</label>
      <input type="text" class="form-control" id="enumber" name="enumber" placeholder="E/XX/XXX"  value="{{old('enumber')}}" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="orderID">OrderID</label>
          <input  readonly="true" type="text" class="form-control" id="OrderID"  name="OrderID" placeholder={{ $order->id }}  value={{ $order->id }}  >
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Ordered Date</label>
          <input type="text" class="form-control" id="orderedDate" name="orderedDate" placeholder={{ $order->ordered_date }} disabled>
        </div>
      </div>


      <div class="form-group">
        <label for="expectedDate ">Expected Date To get </label>
        <input type="Date" class="form-control" id="expected_date" name="expected_date" placeholder="Enter the date to get "   value="{{old('expected_date')}}"required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

      <div class="form-group">
        <label for="describtion">Describtion For Ordering </label>
        <textarea class="form-control" id="description" rows="3" name="description"   value="{{old('description')}}"required></textarea>
      </div>
      <br>
      <div class="form-group">
        <label for="validationServer04" class="form-label"> Select Lecturer    </label>
        <select class="form-select is-invalid" id="selectLecturer" name="selectLecturer" aria-describedby="validationServer04Feedback" required>
          <option selected disabled value="">Choose Lecurer</option>
        
          @foreach ( $lecturers as $lecturer)
          <option>{{$lecturer->name}}</option>
          @endforeach
          
        </select>
       

      
      </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection