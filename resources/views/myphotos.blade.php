@extends('include.signUp')

<form name="exampleForm" class="elegant-aero">
       
    <h2 style="color: darkblue;text-align: center"><strong>  Image Gallery </strong></h2>
    <br>   <br>
    <table class="table table-bordered table-striped table-hover" style="background:  #000;
    background-color: #fff">
    <thead style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;color: darkblue">
            <tr>
              <th class="text-center" >Image</th>
              <th class="text-center">Image Details</th>
             
             
              
              
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
    
    
    

    @endfor
   
          

  

</tr>

</tbody>
</table>
 </form>
 