@extends('include.signUp')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">

@section('content')
<style>
    .alert{
  border-left : 5px solid blue;
          padding:10px;
 }
    .alert-error{
  background : #ff0033;
  color: whitesmoke;
 }
</style>

@if ( Session::has('error') )
<div class="alert alert-error" style="margin-left:900px">
  <strong>{{ Session::get('error') }}</strong>
</div>
@endif
<form name="exampleForm" class="elegant-aero" method="POST" action="signUp_info">
  @csrf
  <label for="" style="text-align: center;color: darkblue;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 28px"><strong>Member Sign Up</strong></label>
  <br> 
  <label>Full Name:</label>
    <input type="text" name="userFirstName" ng-model="firstName" required />
    <div ng-messages="exampleForm.userFirstName.$error">
      <div ng-message="required">This field is required</div>
    </div>

   

    <label>Email Address:</label>
    <input type="email" name="userEmail" ng-model="email" required />
    <div ng-messages="exampleForm.userEmail.$error">
      <div ng-message="required">This field is required</div>
      <div ng-message="email">Your email address is invalid</div>
    </div>

    <label>Phone Number:</label>
   
    
    
    <input type="text" name="userPhoneNumber" ng-model="phoneNumber" ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" required/>
    <div ng-messages="exampleForm.userPhoneNumber.$error">
      <div ng-message="required">This field is required</div>
      <div ng-message="pattern">Must be a valid 10 digit phone number</div>
    </div>

    <label>Address:</label>
    <textarea type="text" name="userMessage" class="form-control" rows="4" ng-model="message" ng-minlength="100" ng-maxlength="1000" required></textarea>
    <div ng-messages="exampleForm.userMessage.$error">
      <div ng-message="required">This field is required</div>
     
    </div>
    <br>
    <br>
    <button type="submit" class="btn btn-success">Sign Up</button>
  </form>

  

    


  
  
  