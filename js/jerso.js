$(document).ready(function(){if("undefined"!==typeof Storage)if(window.localStorage.getItem("status")&&window.localStorage.getItem("datas")){var b=atob(window.localStorage.getItem("status"));$("#nomDetail").html(window.localStorage.getItem("datas").split(",")[0]+" "+window.localStorage.getItem("datas").split(",")[1]);$("#empDetail").html(window.localStorage.getItem("datas").split(",")[3]);$("#rutDetail").html(window.localStorage.getItem("datas").split(",")[5]);$("#plaDetail").html(window.localStorage.getItem("datas").split(",")[7]);
var c=window.localStorage.getItem("datas").split(",")[6];$("#emaDetail").html(c);$.ajax({url:"data/switch.php",type:"POST",data:{hdnOperation:"boleta",_id:b,email:c,token:"dGUgYXRyYXBl"},dataType:"json",success:function(a){"success"==a.Mensaje?($("#hashiko").val(a.Data),$("#hashi").val(a.Data),$("#receiver_id").val(a.Comentario[0]),$("#subject").val(a.Comentario[1]),$("#body").val(a.Comentario[2]),$("#amount").val(a.Comentario[3]),$("#pagDetail").html("$"+a.Comentario[3]),$("#notify_url").val(a.Comentario[7]),
$("#return_url").val(a.Comentario[8]),$("#cancel_url").val(a.Comentario[9]),$("#custom").val(a.Comentario[6]),$("#transaction_id").val(a.Comentario[5]),$("#payer_email").val(a.Comentario[4]),$("#picture_url").val(a.Comentario[10])):console.log(a)}})}else window.location.replace("index.html");else window.location.replace("index.html")});function hubbo(){var b=$("#hashiko").val();$("#hashi").val(b)}setInterval(hubbo,1E3);