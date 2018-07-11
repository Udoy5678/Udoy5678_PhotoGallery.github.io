@extends('include.signUp')


<form name="exampleForm" class="elegant-aero" style="margin-top: 200px;" method="POST" action="{{url('invite_email', ['userid' =>Crypt::encrypt($user_id)])}}">
    @csrf
    <label>Email address to invite:</label>
    <br>
    
    <input type="email" name="userEmail" ng-model="email" required />
    <div ng-messages="exampleForm.userEmail.$error">
      <div ng-message="required">This field is required</div>
      <div ng-message="email">Your email address is invalid</div>
    </div>
    <br>
    <br>
    <button type="submit" class="btn btn-success">Invite</button>

</form>
