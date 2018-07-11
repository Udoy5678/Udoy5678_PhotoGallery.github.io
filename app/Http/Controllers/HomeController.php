<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\reverify;

use DB;
use App\userinfo;
use App\user_imgs;
use Response;
use Session;
use Notification;
use Illuminate\Notifications\Notifiable;


//Auth facade
use Auth;
class HomeController extends Controller
{
    
    
    //
  /*  public function mail()
{
   $name = 'Krunal';
   Mail::to('krunal @appdividend.com')->send(new SendMailable($name));
   
   return 'Email was sent';
}*/
//sign up info
function signUp_info(Request $request)
{
$fullname=$request->userFirstName;
$email=$request->userEmail;
$phonenum=$request->userPhoneNumber;
$address=$request->userMessage;
$userinfo=DB::table('userinfos')->where('email','=',$email)->get();
//dd($userinfo);
if(count($userinfo)==NULL)
{
    
$user_data=array('name'=>$fullname,'email'=>$email,'phone'=>$phonenum,'address'=>$address);
$query = http_build_query(array('aParam' => $user_data));
$input=json_decode(json_encode( $query), True);
//sending mail
$name = $fullname;
   Mail::to($email)->send(new SendMailable($input));

return view('verification_details');

}
else
{
   
    Session::flash('error', 'The email has already been taken');
    return view('signUp'); 
 
}





}
//verify email
function verify_mail($userinfo,$code){

    $verification_code_decrypt=\Crypt::decrypt($code);
    $user_info_decrypt=\Crypt::decrypt($userinfo);
    
 $url_decode_userinfo=urldecode(   $user_info_decrypt)."&";
 //dd($url_decode_userinfo);
 $length=strlen($url_decode_userinfo);
 $user_register=array();
 
 for($i=0;$i<$length;$i++)
 {
if( $url_decode_userinfo[$i]=='=')
{

 for($j=$i+1;$j<$length;$j++)
 {
  
   if( $url_decode_userinfo[$j]=='&'){
   
   $user_register[]=substr($url_decode_userinfo,$i+1,$j-($i+1));

    
     break;
   }
 }
 


}


   
 }
 
 $insert_user_data=array('name'=> $user_register[0],'email'=>$user_register[1],'phone'=>$user_register[2],
 'address' =>$user_register[3], 'verification_code' =>$verification_code_decrypt); 
 //insert user info to database
$insert_user_data_table=DB::table('userinfos')->insert($insert_user_data);
 
$fetch_info=DB::table('userinfos')->where('email','=',$user_register[1])->get();


$user_info=json_decode(json_encode(  $fetch_info), True);
//dd($user_info[0]['id']);
        return view('user_verify_login')->with('user_id',$user_info[0]['id']);
        
        }

//member login
function login_verify(Request $request)
{

$email=$request->userEmail;
$password=$request->userFirstName;
$verify_user=DB::table('userinfos')->where('email','=',$email)->where('verification_code','=',$password)->get();



if(count($verify_user)!=NULL)
{
    //converting into array
    $verify_user_info=json_decode(json_encode(  $verify_user), True);
    
  // dd($input1);
  //session set for multiple variables
  /*
  $user_info = [
    
    "email"          => $email,
    
    "user_id"        => $verify_user_info[0]['id']
  ];*/

session()->put('user_id',$verify_user_info[0]['id']);
return redirect('user_login');
//return view('user_verify_login')->with('user_id',$verify_user_info[0]['id']);

}
else
{
    Session::flash('error', 'The email and password don\'t match');
    return view('master');

}
}
//member log out
function logout()
{
    /*
dd(Session::has('email'));
    dd(session()->get('email'));
   dd( $request->session()->flush());
return view('master');*/

Session::forget('user_id');
  if(!Session::has('user_id'))
   {
     //  dd(Session::has('user_info'));
    return view('master');
   }
  


}
//user image upload
function user_image_upload(Request $request,$user_id)
{
    $user_id=\Crypt::decrypt($user_id);
    $user_image_title=$request->userFirstName;
    $user_image_description=$request->userMessage;
    $user_image_visibility=$request->visibility;
    $user_image=$request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());
    $user_existing_image_title=DB::table('user_imgs')->where('img_title','=',$user_image_title)->get();
    if(count($user_existing_image_title)==NULL)
    {

        $user_img_details=array('img_title'=>$user_image_title,'img_description'=>$user_image_description,'img_visibility'=>$user_image_visibility,'image'=>$user_image,'user_id'=>$user_id);
        $user_img_insert=DB::table('user_imgs')->insert($user_img_details);
        Session::flash('success', 'Photo has been uploaded successfully ');
       
       /* $user_info = [
    
            "email"          => $user_image_title,
            
            "user_id"        =>  $user_id
          ];*/
        
        session()->put('user_id',$user_id);
       
     //  return redirect('user_login_upload');
       
        return view('user_verify_login')->with('user_id',$user_id); 
    }
    else
    {
        Session::flash('error', 'The photo title has already been given ');
        return view('user_verify_login')->with('user_id',$user_id); 
     

    }
   
    
    
    


}
//user own image show
function my_photo($user_id)
{
    $user_id_decrypt=\Crypt::decrypt($user_id);
$user_own_image_show=DB::table('user_imgs')->where('user_id','=',$user_id_decrypt)->get();
$user_own_image=json_decode(json_encode(  $user_own_image_show), True);
$total_images_user=count($user_own_image);
//dd($user_own_image[0]['image']);
$images=array();
for($i=0;$i<$total_images_user;$i++)
{

    $images[]=$user_own_image[$i]['image'].',';
}
//only taking image location and name
$length_img=strlen( json_encode($images));
$img_location=array();
$img=json_encode( str_replace('\\', "/", $images));


//dd($img1);
for($i=0;$i<$length_img;$i++)
{
if( $img[$i]=='/')
{

for($j=$i+1;$j<$length_img;$j++)
{
 
  if( $img[$j]==','){
  
    $img_location[]=substr($img,$i+1,$j-($i+1));

   
    break;
  }
}



}
}
//convert image string
$img_name=array();
$img=json_decode(json_encode(  $img_location), True);
for($k=5;$k<=($total_images_user*6);$k+=6)
{
    $img_name[]=$img[$k];

}
//dd($img);
//dd($user_own_image);

//images details

$a=array($user_own_image);
session()->put('user_id',$user_id_decrypt);

return view('myphotos')->with('images',$img_name)->with('user_own_image',$a)->with('total_images_user',$total_images_user);

}
//invite friends by their mail
function invite_email(Request $request,$user_id)
{
    $user_id_decrypt=\Crypt::decrypt($user_id);
    $invite_mail_address=$request->userEmail;
    //dd( $invite_mail_address);
    $get_user_from_email=DB::table('userinfos')->where('id','=',$user_id_decrypt)->get();
$from_mail=json_decode(json_encode(  $get_user_from_email), True);
    
    $get_user_mail=$from_mail[0]['email'];
  //  dd($get_user_mail);
  $data=array(
'from_mail'=>$get_user_mail,
'to_mail'=>$invite_mail_address,
'user_id'=>$user_id_decrypt

    
  );
  
   Mail::send('emails.invite',$data,function($message) use($data) {
    $message->from($data['from_mail']);
    $message->to($data['to_mail']);
  
   
    

   });
   Session::flash('success', 'Your mail has been sent.');
  

session()->put('user_id',$user_id_decrypt);

return view('user_verify_login')->with('user_id',$user_id_decrypt); 
}
//view image 
function view_image($user_id,$to_mail)
{
    $user_id_decrypt=\Crypt::decrypt($user_id);  
    $to_mail_decrypt=\Crypt::decrypt($to_mail);
   // dd( $to_mail_decrypt);  
    
    //view of specific user images
    $user_own_image_show=DB::table('user_imgs')->where('user_id','=',$user_id_decrypt)
    ->where(function ($query) {
        $query->where('img_visibility','=','Yes')->orWhereNull('img_visibility');
    })->get();
     $user_own_image=json_decode(json_encode(  $user_own_image_show), True);
   // dd($user_own_image[0]['id']);
    $total_images_user=count($user_own_image);
    //dd($user_own_image[0]['image']);
    $images=array();
    //$images id
    $images_id=array();
    
    for($i=0;$i<$total_images_user;$i++)
    {
        $images_id[]=$user_own_image[$i]['id'];
        $images[]=$user_own_image[$i]['image'].',';
    }
    
    //only taking image location and name
    $length_img=strlen( json_encode($images));
    $img_location=array();
    $img=json_encode( str_replace('\\', "/", $images));
    
    
    
    for($i=0;$i<$length_img;$i++)
    {
    if( $img[$i]=='/')
    {
    
    for($j=$i+1;$j<$length_img;$j++)
    {
     
      if( $img[$j]==','){
      
        $img_location[]=substr($img,$i+1,$j-($i+1));
    
       
        break;
      }
    }
    
    
    
    }
    }
   
    $img_name=array();
    $img=json_decode(json_encode(  $img_location), True);
    for($k=5;$k<=($total_images_user*6);$k+=6)
    {
        $img_name[]=$img[$k];
    
    }
   
    
    $a=array($user_own_image);
   // dd($images_id);
   
    return view('image_view')->with('images',$img_name)->with('user_own_image',$a)->with('total_images_user',$total_images_user)->with('images_id',$images_id)->with('to_mail',$to_mail_decrypt);
    

}
//image download
function img_download($images_id ,$to_mail){
    $images_id_decrypt=\Crypt::decrypt($images_id);

//get user mail to send mail after downloading photo
$user_mail=DB::table('userinfos')->select('email')->join('user_imgs','userinfos.id','=','user_imgs.user_id')->where('user_imgs.id','=',$images_id_decrypt)->get();
$mail_user=json_decode(json_encode(  $user_mail), True);

$get_user_mail=$mail_user[0]['email'];

    $to_mail_decrypt=\Crypt::decrypt($to_mail);
   $visitor_register_check=DB::table('userinfos')->where('email','=',$to_mail_decrypt)->get();
   if(count($visitor_register_check) !=NULL)
   {
    
  //  dd( $images_id_decrypt);
  $select_img=DB::table('user_imgs')->where('id','=',$images_id_decrypt)->get();
  $img_select=json_decode(json_encode(  $select_img), True);
  
  //name of the image
  $img_title=$img_select[0]['img_title'];
  //location of the image
$img_loc=$img_select[0]['image'];
 //only taking image location and name
 $length_img=strlen( json_encode($img_loc));
 $img_location=array();
 $img= json_encode(str_replace('\\', "/",$img_loc)).',';
 
 //dd($img);
 
 
 for($i=$length_img;$i>0;$i--)
 {
 if( $img[$i]==',')
 {
   
 for($j=$i-1;$j>0;$j--)
 {
    
   if( $img[$j]=='/'){
    //dd($i,$j);
     $img_location[]=substr($img,$j+1,$i-($j+2));
 
     
     break;
   }

 }
 
 
 
 }
 }
 $img_loc_array=json_decode(json_encode(  $img_location), True);
//dd($img_loc_array);
$file_path="C:/xampp new/htdocs/p/public/images/".$img_loc_array[0];
//dd($file_path);
//mail send to owner 
$data=array(
    'from_mail'=>"photographers@gmail.com",
    'to_mail'=>$get_user_mail,
    'img_title'=>$img_title,
    'downloader_mail'=>$to_mail_decrypt,
    
        
      );
      
       Mail::send('emails.after_download',$data,function($message) use($data) {
        $message->from($data['from_mail']);
        $message->to($data['to_mail']);
      
       
        
    
       });

return Response::download($file_path);

   }
   else
   {
    Session::flash('error', 'You must be a registered member to download this photo.');
    return back(); 

   }
}
//forgot password submit
function forgot_email_pass(Request $request)
{
$email=$request->userEmail;

Mail::to($email)->send(new reverify($email));
Session::flash('success', 'Check your mail and reverify it for changing password.');

    return back(); 
}
//reverify pass
function reverify_pass($email,$code)
{

    $email_decrypt=\Crypt::decrypt($email);
    $code_decrypt=\Crypt::decrypt($code);
    
$get_user_info=DB::table('userinfos')->where('email','=',$email_decrypt)->get();
$get_user_info_array=json_decode(json_encode(  $get_user_info), True);
$user_data=array('id'=>$get_user_info_array[0]['id'],'email'=>$get_user_info_array[0]['email'],'phone'=>$get_user_info_array[0]['phone'],'address'=>$get_user_info_array[0]['address'],'verification_code'=>$code_decrypt);
$update_password=DB::table('userinfos')->where('id','=',$get_user_info_array[0]['id'])->Update($user_data);

return back();
    
}
}
