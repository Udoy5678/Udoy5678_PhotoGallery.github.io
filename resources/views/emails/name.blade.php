

<?php
 $verification_code = substr(md5(uniqid(rand(), true)), 8, 8);

?>


<div>
 Your verification code is <a href="{{url('verification_code', ['userinfo' =>Crypt::encrypt($input),'code' => Crypt::encrypt($verification_code)])}}"   style="color:green"><strong>{{$verification_code}}</strong></a>.Click the <strong>green link</strong> for verification. Use it as your password for logging in next time.Thank You.
 
</div>
