/**
 * Filename: manager.js
 * Author: Danqing Zhao
 */


$(document).ready(function() {
    let start = 0;
    let num = 10;
    $.get("query.php", {"start" : start, "num" : num }, processRequest);
    function processRequest(data, status){
        if(status==="success"){
            $("#result").html(data);
            if(data.match("<table>")===null&&data!==''){
                $('h1').text('MySQL query :"'+$("#query").val()+'" was failed');
            }
            else{
                $('h1').text('MySQL query :"'+$("#query").val()+'" was successful');
            }
        }
        else{
            alert("Error: "+status);
        }
    }

    $("#previous").click(function(){
        if(start > 9){
            start -= 10;
        }
        $.get("query.php", {"start" : start, "num" : num }, processRequest);
    });

    $("#next").click(function(){
        start += 10;
        $.get("query.php", {"start" : start, "num" : num }, processRequest);
    });

    $(".file_button").click(function(){

    });

});