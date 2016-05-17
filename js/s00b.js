$("#enviar").submit(function(){
  event.preventDefault();
  $.ajax({
    url: 'data/switch.php',
    type: 'POST',
    data:{
      'hdnOperation':'hdnLog',
      'email': 	$("#enviar").serializeArray()[0]["value"],
      'pass': 	$("#enviar").serializeArray()[1]["value"]
    },
    dataType:'json',
    success:function(data){
      if(data.Mensaje=="success"){
        window.location.replace("app/dashboard.php");
      }else if (data.Mensaje=='pending') {
        var coment = btoa(data.Data[0]);
        var datos = new Array(data.Cliente[1],data.Cliente[2],data.Cliente[3],data.Cliente[4],data.Cliente[5],data.Cliente[6],data.Cliente[7],data.Tipo);
        window.localStorage.setItem("status", coment);
        window.localStorage.setItem("datas", datos);
        window.location.href = "./pago.php?axeon=" + coment + "&Token=dGUgYXRyYXBl&object=" + datos;
      }else{
        $('#myModal').modal('toggle');
        $("#informe").html('<strong>Error!</strong> ' + data.Comentario);
        $('#modalInfo').modal('show');
      }
    }
  });
});
