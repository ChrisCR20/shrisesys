function init(){
  $("#compra_form").on("submit",function(e)
  {
    guardar(e);
  });



        $('.select2').select2()
}
$(document).ready(function(){
  $('#tablacompras').DataTable({
      "responsive": false,
      "autoWidth": false,
     "searching": true,
     order:[[2,'asc']],
     "lengthChange": true,
      "ajax":{
          url:'indexcompras',
          type: "get",
          dataType: "json",
      },
      columns :[
          {
              data:'Factura',
              name:'Factura'
          },
          {
            data:'fecha',
            name:'fecha'
        },
          {
            data:'nombreproveedor',
            name:'nombreproveedor'
        },
        {
          data:'totalcompra',
          name:'totalcompra'
      },
          {
              data:'action',
              name:'action'
          },
          
      ],           "language": {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
      }
          });

          
      

});

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});


$(document).on("click","#btnnuevacompra",function(){
// $('#modaltitle').html('Nuevo Registro');
// $('#sede_form').get(0).reset();
// $('#sede_id').val('0');
$('#modalnuevacompra').modal('show');

// $.ajax({url:'/sede/sedec/selectmuni'}).done(function(data){
//     // data = JSON.parse(data);
//     //  console.log(data.pais);
//     //  $municipio = data.municipio;
    
//     //$('#id_municipio').html(data.municipio);
//      //$('#id_pais').html(data.$municipio);
//     // $('#nombre').val(data[0].nombre);
//     // $('#sede_id').val(data[0].id_cedecentral);
     
//     // console.log(data);
//  });


});


function guardar(e) {
    e.preventDefault();

    var formData = new FormData(document.getElementById("compra_form"));
    //var formData = new FormData();
    var itemsDataPA=[];
    var tablaPA=$("#tblacademico tr");

    
    tablaPA.each(function(){
      var titulo = $(this).find('td').eq(1).html();
      var establecimiento = $(this).find('td').eq(2).html();
      var idtpgr = $(this).closest('tr').find('input[id="tpgrado"]').val();
      valor = new Array(titulo,establecimiento,idtpgr);
      itemsDataPA.push(valor);
  });
  console.log(itemsDataPA);
  formData.append('fechafactc', $('#fechafactc').val());
  formData.append('serie', $('#serie').val());
  formData.append('numerodocto', $('#numerodocto').val());
  formData.append('id_proveedor', $('#id_proveedor').val());
  formData.append('id_tipopago', $('#id_tipopago').val());
  //formData.append('itemsPA', itemsDataPA);

if(itemsDataPA.length>1)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"compra/ingreso",
      type:"POST",
      data: formData,
      contentType:false,
      processData:false,
      success: function(e){
      // console.log(data);
       // alert('nada');
       $('#compra_form')[0].reset();
       $('#tablacompras').DataTable().ajax.reload();
      //   $('#tick_titulo').val('');

        $('#modalnuevacompra').modal('hide');
        

    
        // Toast.fire({
        //     type: 'success',
        //     title: 'La acción fue completada exitosamente'
            
        //   })
        //   $(document).Toasts('create', {
        //     class: 'bg-success',
        //     body: 'Accion ejecutada con éxito',
        //      autohide: true,
        //         delay: 2000,
        //   })

        toastr.success('Factura registrada correctamente', 'Buen Trabajo',{timeOut: 2500})
      }
     
    
    });
}else{
  toastr.warning('Debe agregar al menos un item a la factura', 'Atención',{timeOut: 2500})
}
    

    
  }

  var contacade=0;
function agregarest()
{
  nmtitulo=$("#subtotal").val();
  nminstituto=$("#cantidad").val();
  tipgradoval=$("#id_producto").val();
  tipgradotxt=$("#id_producto option:selected").text();

  if ((nmtitulo!="") && (nminstituto!="") )
  {
      var filaAca='<tr class="selected" id="filaAca'+contacade+'"> <td><button type="button"   class="btn btn-danger" onclick="eliminarR('+contacade+');">X</button></td><td><input type="hidden" name="nminstituto[]" value="'+nminstituto+'">'+nminstituto+'</td> <td><input type="hidden" id="tpgrado" name="tpgrado[]" value="'+tipgradoval+'">'+tipgradotxt+'</td><td><input type="hidden" id="nmtitulo" name="nmtitulo[]" value="'+nmtitulo+'">'+nmtitulo+'</td>  </tr>';
      contacade++;
      limpiarAca();
      $('#tblacademico').append(filaAca);
  }
  else
  {
    toastr.warning('Los campos "Cantidad y Subtotal" son requeridos', 'Atención',{timeOut: 2500})
     // alert('Todos los campos son obligatorios')
  }   
}
function limpiarAca()
{
  $("#cantidad").val("");
  $("#subtotal").val("");
}

function eliminarR(index)
{

      $("#filaAca" + index).remove();

}


// function editarcc(id_detallefc){ 

//   var dato=id_detallefc

// $.ajax({
//   headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   },
// url:"editcompras",
// type:"GET",
// data: {dato},
// success: function(e){
// // console.log(data);

//  toastr.warning('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
// }


// });
// }



function validacionkeys(e){
  tecla = e.keyCode || e.which;
  tecla_final = String.fromCharCode(tecla);
  //Tecla de retroceso para borrar, siempre la permite
  if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
  {
      return true;
  }

  if (tecla==13) buscarclientes();

  // Patron de entrada, en este caso solo acepta numeros
  patron =/[0-9]/;
  //patron =/^\d{9}$/;
  return patron.test(tecla_final);
}


  
init();