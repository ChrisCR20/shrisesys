function init(){
    $("#categoria_form").on("submit",function(e)
    {
      guardar(e);
    });
  }

  $(document).ready(function(){
    $('#tablacategoria').DataTable({
        "responsive": false,
        "autoWidth": false,
       "searching": true,
       "lengthChange": true,
        "ajax":{
            url:'indexcategoria',
            type: "get",
            dataType: "json",
        },
        columns :[
            {
                data:'id_categoria',
                name:'id_categoria'
            },
            {
                data:'nombrecategoria',
                name:'nombrecategoria'
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
        url:"producto/ingreso",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#categoria_form')[0].reset();
         $('#tablacategoria').DataTable().ajax.reload();
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