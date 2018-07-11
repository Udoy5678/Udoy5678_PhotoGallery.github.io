@extends('include.signUp')
@yield('content')

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
 
<form name="exampleForm" class="elegant-aero">
  <div class="text-center p-t-136">
    <a class="txt2" href="/" style="margin-left: 373px;
    ">
        Click here to  register
        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
    </a>
</div>  
       <br> 
       <br> 
    <h2 style="color: darkblue;text-align: center"><strong>  Image Gallery </strong></h2>
    <br>   <br>
    <table class="table table-bordered table-striped table-hover" style="background:  #000;
    background-color: #fff">
    <thead style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;color: darkblue">
            <tr>
              <th class="text-center" >Image</th>
              <th class="text-center">Image Details</th>
              <th class="text-center">Action</th>
              
              
              
             
             
              
              
            </tr>
          </thead>
          <tbody >
                        @for($i=0;$i<$total_images_user;$i++)
    <tr>
        
            <td class="text-center" width="70%" ><img src="../../images/{{$images[$i]}}" alt="" width="30%" height="20%"></td>
           
         
          
           
    <td class="text-center" width="90%"><p>
           <strong style="color: #7a00ff;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Imgae Title:</strong> {{$user_own_image[0][$i]["img_title"]}}</p>
  
   <p><strong style="color: #7a00ff;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Imgae Description:</strong>  {{$user_own_image[0][$i][  "img_description"]}}</p>
    
    
   <p> <strong style="color: #7a00ff;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Imgae Visibility:</strong>  {{$user_own_image[0][$i][   "img_visibility"]}}
 
</p>
    </td>
    
    
    <td ><a href="{{url('img_download', ['images_id' =>Crypt::encrypt($images_id[$i]),'to_mail' =>Crypt::encrypt($to_mail)])}}">Download</a></td>

    @endfor
   
          

  

</tr>

</tbody>
</table>
 </form>