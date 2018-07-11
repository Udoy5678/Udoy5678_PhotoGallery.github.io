@include('include.signUp')
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




<form name="exampleForm" class="elegant-aero" method="POST" action="login_verify" style="margin-top:105px">
  @csrf
    
       <label for="" style="text-align: center;color: darkblue;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 28px"><strong>Member Login</strong></label>
       <br>
       <br>

    <label>Email Address:</label>
    <input type="email" name="userEmail" ng-model="email" required />
    <div ng-messages="exampleForm.userEmail.$error">
      <div ng-message="required">This field is required</div>
      <div ng-message="email">Your email address is invalid</div>
    </div>

    <br>
    <br>
    <label>Password:</label>
    <input type="password" name="userFirstName" ng-model="firstName" style="width: 60%"  required />
    <div ng-messages="exampleForm.userFirstName.$error">
      <div ng-message="required">This field is required</div>
    </div>
    <br>
    <br>
    <button type="submit" class="btn btn-success">Login</button>
    <br>
    <br>
    <div class="text-center p-t-12">
            <span class="txt1">
                Forgot
            </span>
            <a class="txt2" href="forgot_password">
                 Password?
            </a>
        </div>
        <br>
        <br>
        

</form>
