<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', 'HomeController@mail');
/*
    Route::get('/',function(){

        return view('master');
        
        });
*/
Route::get('/',function(){

    return view('first_page');
    
    });
    //login main page
    Route::get('/login',function(){

        return view('master');
        
        });

//signUp main page
Route::get('/signUp',function(){

    return view('signUp');
    
    });
    //sign up info
Route::POST('/signUp_info','HomeController@signUp_info');
//user verify through mail
Route::POST('/verify_email','HomeController@verify_email');

//verification code
Route::get('verification_code/{userinfo}/{code}','HomeController@verify_mail');
//member login
Route::POST('/login_verify','HomeController@login_verify');
//member logout



    Route::get('user_login',function(){

        //dd(Session::get('user_info'));
           $user_id=Session::get('user_id');
           //if($user_info['user_id']==)
          // $user_id=$user_info['user_id'];
          // return 'user_verify_login';
          if($user_id!=NULL)
          {
       session()->put('user_id',$user_id);

      
            return view('user_verify_login')->with('user_id',$user_id);
          }
          else
          {

            return view('master');
          }
          
       })->middleware('checkuser');

        
      


Route::get('/logout','HomeController@logout');

//upload photo
Route::get('upload_photo/{user_id}',function($user_id){
    $user_id_decrypt=\Crypt::decrypt($user_id);
return view ('upload_photo')->with('user_id',$user_id_decrypt);
});

//user image upload
Route::POST('user_image_upload/{userid}','HomeController@user_image_upload');
//back to this page after logout
Route::get('user_image_upload/{userid}',function($userid){
   

    return view ('first_page')->with('user_id',$userid);


});

Route::get('my_photo/{user_id}','HomeController@my_photo');
  //invite friends main page
Route::get('invite_friends/{user_id}',function($user_id){

    $user_id_decrypt=\Crypt::decrypt($user_id);
    return view ('invite_friends')->with('user_id',$user_id_decrypt);


});
  //invite friends by mail
  Route::POST('invite_email/{user_id}','HomeController@invite_email');
 //back to this page after logout
Route::get('invite_email/{userid}',function($userid){

    return view ('first_page')->with('user_id',$userid);


});

  //view image
Route::get('view_image/{user_id}/{to_mail}','HomeController@view_image');
  //image download
Route::get('img_download/{images_id}/{to_mail}','HomeController@img_download');
//Auth::routes();

//forgot password
Route::get('forgot_password',function(){

return view('forgot_pass_main');

});
//forgot password submit
Route::POST('forgot_email_pass','HomeController@forgot_email_pass');
//reverify password
Route::get('reverify_pass/{email}/{code}','HomeController@reverify_pass');