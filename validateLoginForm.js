/*
Filename: validateLoginForm.js
Author: Danqing Zhao
*/


$(document).ready(function(){

    jQuery.validator.addMethod("nameRegex", function(value, element) {
        return this.optional(element) || /^[a-z0-9_.*\\s]+$/i.test(value);
    }, "Name must contain only letters & number. No space allowed");

    let username;
    let password;
    let remember_me;

    if($.cookie!==''){//use cookie
        $("#username").val(getCookie('username')) ;
        $("#password").val(getCookie('password')) ;
    }

    // if user submits the form, validate it
    $('.submitButton').click(function(){
        if($('.loginForm').valid()){
            username = $("#username").val();
            password = $("#password").val();
            remember_me = $("#remember_me").get(0).checked;
            $.get("login.php", {"username": username, "password": password}, processRequest);

        }
    });

    function getCookie(cname)
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++)
        {
            var c = ca[i].trim();
            if (c.indexOf(name)==0) return c.substring(name.length,c.length);
        }
        return "";
    }

    function processRequest(data, status){
        if(status === "success"){
            //set up cookie
            let d = new Date();
            d.setTime(d.getTime()+(7*24*60*60*1000));
            let expires = d.toGMTString();
            $.cookie = "username="+username+";password="+password+";expires="+expires;

            if(data==="user" ){
                window.location.href="upload.html";
            }
            else if(data==="manager"){
                window.location.href="manager.html";
            }

            else{
                $("#error_msg").text(data);
            }
        }
        else{
            alert(status);
            $("#error_msg").text(status);
        }
    }


    $(".loginForm").validate({
        rules: {
            username:{
                required:true,
                minlength: 3,
                nameRegex: true,
            },

            password:{
                required:true,  
                minlength: 6      
            },

        },
        messages: {
            username:{
                required:"please enter username",
                nameRegex: "username contain illegal characters",
                minlength: "username must be at least 3 characters"
            },

            password:{
                required:"please enter password",  
                minlength: "password must be at least 6 characters"      
            },
    
        },
        errorPlacement:function(error,element) {
            error.appendTo(element.siblings(".error"));
        }
    });

});