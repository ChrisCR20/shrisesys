function init(){
    $("#medida_form").on("submit",function(e)
    {
      guardar_medida(e);
    });
  
  
  
  
  }
  $(function () {
      //Initialize Select2 Elements   
      $('.select2').select2();
    
  });
  
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
        $.ajaxSetup({
      headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  
  
  $(document).on("click","#btnnuevamedida",function(){
  
      $('#modalnuevamedida').modal('show');
   
  });
  
  function guardar_medida(e) {
      e.preventDefault();
  
      var formData = new FormData($("#medida_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"crearmedida",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#medida_form')[0].reset();
        //  $('#sede_data').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
        $('#id_medida').trigger('change.select2');
          $('#modalnuevamedida').modal('hide');
          
  
      
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
  
          toastr.success('Unidad de medida agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
       
      
      });
      
    }
      
    
  init();