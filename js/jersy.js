$(document).ready(function(){
  if (typeof(Storage) !== "undefined") {
    if(!window.localStorage.getItem("status") || !window.localStorage.getItem("datas")){
      window.location.replace('index.html');
    }else{
      var _id 		= atob(window.localStorage.getItem("status"));
      $("#nomDetail").html(window.localStorage.getItem("datas").split(',')[0] + ' ' + window.localStorage.getItem("datas").split(',')[1]);
      $("#empDetail").html(window.localStorage.getItem("datas").split(',')[3]);
      $("#rutDetail").html(window.localStorage.getItem("datas").split(',')[5]);
      $("#plaDetail").html(window.localStorage.getItem("datas").split(',')[7]);
      var email 	= window.localStorage.getItem("datas").split(',')[6];
      $("#emaDetail").html(email);
      $.ajax({
      url: 'data/switch.php',
      type: 'POST',
      data: {
        'hdnOperation': "boleta",
        '_id': _id,
        'email': email,
        'token': 'dGUgYXRyYXBl'
      },
      dataType: 'json',
      success: function(data){
        if(data.Mensaje=="success"){
          $("#hashiko").val(data.Data);
          $("#hashi").val(data.Data);
          $("#receiver_id").val(data.Comentario[0]);
          $("#subject").val(data.Comentario[1]);
          $("#body").val(data.Comentario[2]);
          $("#amount").val(data.Comentario[3]);
          $("#pagDetail").html('$' + data.Comentario[3]);
          $("#notify_url").val(data.Comentario[7]);
          $("#return_url").val(data.Comentario[8]);
          $("#cancel_url").val(data.Comentario[9]);
          $("#custom").val(data.Comentario[6]);
          $("#transaction_id").val(data.Comentario[5]);
          $("#payer_email").val(data.Comentario[4]);
          $("#picture_url").val(data.Comentario[10]);
        }else{
          console.log(data);
        }
      }
    });
    }
  } else {
    window.location.replace('index.html');
  }
});

function hubbo(){
  var a = $("#hashiko").val();
  $("#hashi").val(a);
}
setInterval(hubbo, 1000);
