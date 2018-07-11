@extends('include.signUp')

    
@if(Session::has('user_id'))   
<form name="exampleForm" class="elegant-aero" method="POST" action="{{url('user_image_upload', ['userid' =>Crypt::encrypt($user_id)])}}" id="defaultForm" enctype="multipart/form-data">
        @csrf
        
<br>
        <label for="" style="text-align: center;color: darkblue;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 28px"><strong>Photo Information</strong></label>
        <br>
        <br>
        
          <label>Photo Title:</label>
          <input type="text" name="userFirstName" ng-model="firstName" required />
          <div ng-messages="exampleForm.userFirstName.$error">
            <div ng-message="required">This field is required</div>
          </div>
          <label>Description:</label>
          <textarea type="text" name="userMessage" class="form-control" rows="4" ng-model="message" ng-minlength="100" ng-maxlength="1000" required></textarea>
          <div ng-messages="exampleForm.userMessage.$error">
            <div ng-message="required">This field is required</div>
           
          </div>
          <br>
          <br>
          <label>Visibility(<strong>Optional</strong>):</label>
          <div>
          <div class="radio">
                <label style="color:#666">
                    <input type="radio" name="visibility" value="Yes" /> Yes
                </label>
            </div>
            <br>
            <div class="radio">
                <label style="color:#666">
                    <input type="radio" name="visibility" value="No" /> No
                </label>
            </div>
        </div>
            <br>
            <br>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
          <script>
          (function($) {
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

$(function() {
    $('#image').checkFileType({
        allowedExtensions: ['jpg', 'jpeg','png'],
        success: function() {
            alert('Success');
        },
        error: function() {
            alert('Image format JPEG and PNG only');
        }
    });
    var uploadField = document.getElementById("image");
    uploadField.onchange = function() {
    if(this.files[0].size > 307200){
       alert("File size is too big!");
       this.value = "";
    };
};
});
          
          </script>
            <div>
                    <label for="image" style=" display: block;
                    
                    margin-bottom: 0.5em;color: #666;">Upload image (<strong>JPEG and PNG only</strong>):</label>
                    <input type="file" name="image" id="image" required/>
                   
                </div>
<br>
<br>


           
          <button type="submit" class="btn btn-success">Submit</button>
          </form>
          @endif