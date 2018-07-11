

<?php
$verification_code = substr(md5(uniqid(rand(), true)), 8, 8);

?>


<div>
Your reverification code is <a href="{{url('reverify_pass', ['email' =>Crypt::encrypt($email),'code' => Crypt::encrypt($verification_code)])}}"   style="color:green"><strong>{{$verification_code}}</strong></a>.Click the <strong>green link</strong> for verification. Use it as your password for logging in next time.Thank You.

</div>
