@extends('include.signUp')
@yield('content')
{{--flash message--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">
{{--flash message--}}
<style>
        .alert{
      border-left : 5px solid blue;
              padding:10px;
     }
        .alert-error{
      background : #ff0033;
      color: whitesmoke;
     }
     .alert-success{
      background : green;
      color: whitesmoke;
     }
    </style>
    {{--error message--}}
    @if ( Session::has('error') )
    <div class="alert alert-error" style="margin-left:900px">
      <strong>{{ Session::get('error') }}</strong>
    </div>
    @endif
    {{--error message--}}
    {{--success  message--}}
    @if ( Session::has('success') )
    <div class="alert alert-success" style="margin-left:900px">
      <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif
    {{--success  message--}}

{{--session get  {{ Session::get('user_info')}} {{ Session::get('user_id')}}
    <a href="logout">Sign Out</a>--}}

@if(Session::has('user_id'))             
    
<form name="exampleForm" class="elegant-aero" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 22px;    text-align: center;margin-top: 169px; " >

  <img src="https://use.fontawesome.com/releases/v5.0.13/svgs/solid/sign-out-alt.svg" style="width:8%;margin-left: 308px; color:#007bff;">
  <a href="logout" ><p style="
  margin-top: -35px;
  margin-left: 439px;color: #7a00ff;
  font-size: 22px;">Logout</p></a>
  <br>
  <br>
  <a href="{{url('my_photo', ['userid' =>Crypt::encrypt($user_id)])}}">My Photos</a>
  <br>
  <br>
  
  <a href="{{url('upload_photo', ['userid' =>Crypt::encrypt($user_id)])}}">Upload Photos</a>
  <br>
  <br>
  
  <a href="{{url('invite_friends', ['userid' =>Crypt::encrypt($user_id)])}}">Invite Friends</a>
  <br>
  <br>
  
  
  
      </form>
    @else
        please signin

    @endif
