function init(){
  $("#categoria_form").on("submit",function(e)
  {
    guardar(e);
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



$(document).on("click","#btnnuevacategoria",function(){

    $('#modalnuevacategoria').modal('show');
 
});

function guardar(e) {
    e.preventDefault();

    var formData = new FormData($("#categoria_form")[0]);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"ingreso",
      type:"POST",
      data: formData,
      contentType:false,
      processData:false,
      success: function(e){
      // console.log(data);
       // alert('nada');
       $('#categoria_form')[0].reset();
      //  $('#tablasucursal').DataTable().ajax.reload();
      //   $('#tick_titulo').val('');
      $('#id_categoria').trigger('change.select2');
        $('#modalnuevacategoria').modal('hide');
        

    
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

        toastr.success('Categoría agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
      }
     
    
    });
    
  }
    
  
init();