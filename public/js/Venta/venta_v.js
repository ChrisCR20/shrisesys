function init(){
    $("#compra_form").on("submit",function(e)
    {
      guardar(e);
    });
  
          $('.select2').select2()
  }

  
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
        $.ajaxSetup({
      headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  
  
  function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData(document.getElementById("compra_form"));
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
    formData.append('itemsPA', itemsDataPA);
  
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

  init();