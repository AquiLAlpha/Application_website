//Filename: validateRegForm.js
//Author: Danqing Zhao


$(document).ready(function(){

    // if user submits the form, validate it
    $('.submitButton').click(function(){
        let username = $("#usernameInput").val();
        let password = $("#passwordInput").val();
        let email = $("#emailInput").val();
        if($('.regForm').valid()){
            $.get("register.php", {"username": username, "password": password, "email": email}, processRequest);

        }
    });

    function processRequest(data, status){
        if(status === "success"){
            if(data.match("Success") ){
                window.location.href="upload.html";
            }

            else{
                $(".msg").html(data);
            }
        }
        else{
            $(".msg").html(status);
        }
    }


    $(".regForm").validate({
        rules: {
            username:{
                required:true,
                minlength: 3
            },

            email:{
                required: true,
                email: true
            },
            password:{
                required:true,  
                minlength: 6      
            },
            repeat_password:{
                required:true,
                equalTo: "#passwordInput"       
            },
            accept_terms:{
                required:true
            }
        },
        messages: {
            username:{
                required:"please enter username",
                minlength: "username must be at least 3 characters"
            },

            email:{
                required: "please enter email address",
                email: "email address invalid"
            },
            password:{
                required:"please enter password",  
                minlength: "password must be at least 6 characters"      
            },
            repeat_password:{ 
                required: "please repeat password",
                equalTo: "the passwords do not match"        //输入值必须和 #password1 相同
            },
            accept_terms:{
                required:"please accept our terms"
            }
        },
        errorPlacement:function(error,element) {
            error.appendTo(element.siblings(".error"));
        }
    });

});