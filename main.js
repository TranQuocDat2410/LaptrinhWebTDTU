"use strict";
$(document).ready(function(){

    $.get('get-user.php',function(data){
        console.log(data);
        $("#list-user tbody tr").remove();
        data.data.forEach(user =>{
            let userCell = $('<tr> <th scope="row">'+ user.id +'</th> <td>'+ user.name +'</td> <td>'+user.phongban+'</td> <td>'+ user.chucvu +'</td> <td> <button class="btn btn-success" onclick="btn_view_user(this)">View</button>')
            let userStr = JSON.stringify(user);
            userCell.attr("userInfo",userStr)
            // console.log(userStr);
            $("#list-user tbody").append(userCell);
        })
    },"json")

    // $("a.add-user-function").click(e =>{
    //     e.preventDefault();
    //     console.log("clicked");
    //     $("#add_user_modal_form").modal({
    //         backdrop: 'static',
    //         keyboard: false
    //     })
    // })

    $(".btn-add-user").click(e => {
        let userInfo = {
            name: $("#name").val(),
            username: $("#username").val(),
            address: $("#address").val(),
            birthday: $("#birthday").val(),
            gender: $("input[name='gender']:checked").val(),
            room: $("#list_room").val(),
            salary: $("#salary").val()
        }
        $.post("add-user.php",userInfo,function(data){
            console.log(data);
        },"json");
    })

});

function btn_view_user(element){
    let userinfoStr = $(element.parentNode.parentNode).attr("userinfo")
    let userinfo = JSON.parse(userinfoStr)
    let id = userinfo['id']
    location.href = "detail-user.php?id=" + id
}