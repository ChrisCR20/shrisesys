function init(){
    $("#marca_form").on("submit",function(e)
    {
      guardar_marca(e);
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
  
  
  
  $(document).on("click","#btnnuevamarca",function(){
  
      $('#modalnuevamarca').modal('show');
   
  });
  
  function guardar_marca(e) {
      e.preventDefault();
  
      var formData = new FormData($("#marca_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"crear",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#marca_form')[0].reset();
        //  $('#sede_data').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
        $('#id_marca').trigger('change.select2');
          $('#modalnuevamarca').modal('hide');
          
  
      
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
  
          toastr.success('Marca agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
       
      
      });
      
    }
      
    
  init();