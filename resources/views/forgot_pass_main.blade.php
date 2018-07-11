@extends('include.signUp')
{{--success  message--}}
@if ( Session::has('success') )
<div class="alert alert-success" style="margin-left:900px">
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif
{{--success  message--}}
{{--{{url('invite_email', ['userid' =>Crypt::encrypt($user_id)])}}--}}
<form name="exampleForm" class="elegant-aero" style="margin-top: 200px;" method="POST" action="forgot_email_pass">
    @csrf
    <label>Enter your registered email:</label>
    <br>
    
    <input type="email" name="userEmail" ng-model="email" required />
    <div ng-messages="exampleForm.userEmail.$error">
      <div ng-message="required">This field is required</div>
      <div ng-message="email">Your email address is invalid</div>
    </div>
    <br>
    <br>
    <button type="submit" class="btn btn-success">verify</button>

</form>
