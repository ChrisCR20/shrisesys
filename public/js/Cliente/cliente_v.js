function init(){
  $("#cliente_form").on("submit",function(e)
  {
    guardar(e);
  });

  $("#cliente_form_edit").on("submit",function(e)
  {
    edicion(e);
  });
}
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});


$(document).ready(function(){
  $('#tablacliente').DataTable({
      "responsive": false,
      "autoWidth": false,
     "searching": true,
     "lengthChange": true,
      "ajax":{
          url:'indexcliente',
          type: "get",
          dataType: "json",
      },
      columns :[
          {
              data:'nitcliente',
              name:'nitcliente'
          },
          {
            data:'nombrecliente',
            name:'nombrecliente'
           },
          {
              data:'telefonocliente',
              name:'telefonocliente'
          },
          {
              data:'direccioncliente',
              name:'direccioncliente'
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
  

   function eliminar($id)
   {
    alert($id); 
   }






$(document).on("click","#btnnuevocliente",function(){

    $('#modalnuevocliente').modal('show');

});
$(document).on("click","#btneditarempresa",function(){

  

});
function guardar(e) {
    e.preventDefault();

    var formData = new FormData($("#cliente_form")[0]);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"cliente/ingreso",
      type:"POST",
      data: formData,
      contentType:false,
      processData:false,
      success: function(e){
      // console.log(data);
       // alert('nada');
       $('#cliente_form')[0].reset();
       $('#tablacliente').DataTable().ajax.reload();
      //   $('#tick_titulo').val('');
        $('#modalnuevocliente').modal('hide');


        toastr.success('Cliente agregado exitosamente', 'Buen Trabajo',{timeOut: 3000});
      }
     
    
    });
    
  }
  function editar(id_cliente){
      var idcliente = id_cliente;
      $.ajax({url:'cliente/obtener/'+idcliente}).done(function(data){
          console.log(data);
          $('#nombreedit').val(data[0].nombrecliente);
          $('#nitedit').val(data[0].nitcliente);
          $('#emailedit').val(data[0].emailcliente);
          $('#telefonoedit').val(data[0].telefonocliente);
          $('#direccionedit').val(data[0].direccioncliente);
          $('#id_cliente').val(data[0].id_cliente);
          // $('#sede_id').val(data[0].id_sede);
  
         // console.log(data);
      });
      $('#modaleditarcliente').modal('show');
  }

  function edicion(e){
      e.preventDefault();

      var formData = new FormData($("#cliente_form_edit")[0]);

     // alert('vv');
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"cliente/edicion",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#cliente_form_edit')[0].reset();
         $('#tablacliente').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
          $('#modaleditarcliente').modal('hide');

  
         toastr.warning('Cliente editado exitosamente', 'Buen Trabajo',{timeOut: 3000})
        }
       
      
      });   
     // toastr.success('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
  
    
  
init();