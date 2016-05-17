$('#formu').submit(function() {
  $(".loader").fadeIn("slow");
});

$("#forma").submit(function(event){
    // Stop form from submitting normally
    event.preventDefault();
    // Get some values from elements on the page:
    var estado    = $("#estado").val();
    var buscar    = $("#buscar").val();
  $.ajax({
    url: '../data/toggle.php',
    type: 'POST',
    data: {
      'estado': estado,
      'hdnOperation': "hdnBusquedaAvanzada",
      'buscar': buscar
    },
    dataType: 'json',
    success: function (data) {
      //What to do with that data...
      var contador = 0;
      var bob = "";
      var lic = "";
      if(data.Mensaje=="success"){
        data.Resultado.forEach(elem => {
          if(contador==0){
            lic = elem;
            bob += '<tr><td style="width:15%;">' + elem + '</td>';
            contador++;
          }else if (contador==3) {
            bob += "<td><a data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"modaldataJAV('" + lic +  "')\"><button class=\"btn btn-info btn-circle\"><i class=\"fa fa-search\"></i></button></a> ";
            bob += " <button class=\"btn btn-default btn-circle\" onclick=\"setFav('" + lic +  "')\"><i class=\"fa fa-star\"></i></button></tr>";
            contador=0;
          }else if (contador==1) {
            bob += '<td style="width:50%;">' + elem + '</td>';
            contador++;
          }else{
            bob += '<td>' + elem + '</td>';
            contador++;
          }
        });
      }else{
        bob = "<tr><td colspan=\"4\" style=\"text-align:center;\"class=\"alert alert-danger\">Sin Resultados</td></tr>";
      }
      document.getElementById("content").innerHTML = bob;
    }
  });
});

function setFav(licCode){
  var id = $("#ide").val();
  $.ajax({
    url: '../data/toggle.php',
    type: 'POST',
    data: {
        'licCode': licCode,
        'hdnOperation': "hdnAddFav",
        'id': id
    },
    dataType: 'json',
    success: function (data) {
      alert(data.Mensaje);
      }
  });
}
