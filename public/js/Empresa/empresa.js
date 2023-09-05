function init(){
    $("#empresa_form").on("submit",function(e)
    {
      guardar(e);
    });

    $("#empresa_form_edit").on("submit",function(e)
    {
      edicion(e);
    });
  }

 
  $(document).ready(function(){
    $('#tablaempresa').DataTable({
        "responsive": false,
        "autoWidth": false,
       "searching": true,
       "lengthChange": true,
        "ajax":{
            url:'indexempresa',
            type: "get",
            dataType: "json",
        },
        columns :[
            {
                data:'id_empresa',
                name:'id_empresa'
            },
            {
                data:'nombre_empresa',
                name:'nombre_empresa'
            },
            {
                data:'descripcion',
                name:'descripcion'
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


  
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
        $.ajaxSetup({
      headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  
  
  $(document).on("click","#btnnuevaempresa",function(){
  
      $('#modalnuevaempresa').modal('show');

  });
  $(document).on("click","#btneditarempresa",function(){
  
    

});
  function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData($("#empresa_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"empresa/ingreso",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#empresa_form')[0].reset();
         $('#tablaempresa').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
          $('#modalnuevaempresa').modal('hide');

  
          toastr.success('Empresa agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
       
      
      });
      
    }
    function editar(id_empresa){
        var idempresa = id_empresa;
        $.ajax({url:'empresa/obtener/'+idempresa}).done(function(data){
            console.log(data);
            $('#nombreedit').val(data[0].nombre_empresa);
            $('#descripedit').val(data[0].descripcion);
            $('#id_empresa').val(data[0].id_empresa);
            // $('#sede_id').val(data[0].id_sede);
    
           // console.log(data);
        });
        $('#modaleditarempresa').modal('show');
    }

    function edicion(e){
        e.preventDefault();
  
        var formData = new FormData($("#empresa_form_edit")[0]);

       // alert('vv');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"empresa/edicion",
          type:"POST",
          data: formData,
          contentType:false,
          processData:false,
          success: function(e){
          // console.log(data);
           // alert('nada');
           $('#empresa_form_edit')[0].reset();
           $('#tablaempresa').DataTable().ajax.reload();
          //   $('#tick_titulo').val('');
            $('#modaleditarempresa').modal('hide');
  
    
           toastr.warning('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
         
        
        });   
       // toastr.success('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
    
      
    
  init();