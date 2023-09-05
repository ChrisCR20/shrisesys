function init(){
    $("#proveedor_form").on("submit",function(e)
    {
      guardar(e);
    });
  
    $("#proveedor_form_edit").on("submit",function(e)
    {
      edicion(e);
    });
  }
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
  $.ajaxSetup({
  headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  
  $(document).ready(function(){
    $('#tablaproveedor').DataTable({
        "responsive": false,
        "autoWidth": false,
       "searching": true,
       "lengthChange": true,
        "ajax":{
            url:'indexproveedor',
            type: "get",
            dataType: "json",
        },
        columns :[
            {
                data:'nombreproveedor',
                name:'nombreproveedor'
            },
            {
              data:'direccionproveedor',
              name:'direccionproveedor'
             },
            {
                data:'nitproveedor',
                name:'nitproveedor'
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
  
  
  
  
  
  
  $(document).on("click","#btnnuevoproveedor",function(){
  
      $('#modalnuevoproveedor').modal('show');
  
  });
  function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData($("#proveedor_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"proveedor/ingreso",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#proveedor_form')[0].reset();
         $('#tablaproveedor').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
          $('#modalnuevoproveedor').modal('hide');
  
  
          toastr.success('Proveedor agregado exitosamente', 'Buen Trabajo',{timeOut: 3000});
        }
       
      
      });
      
    }
    function editar(id_proveedor){
        var idproveedor = id_proveedor;
        $.ajax({url:'proveedor/obtener/'+idproveedor}).done(function(data){
            console.log(data);
            $('#nombreedit').val(data[0].nombreproveedor);
            $('#nitedit').val(data[0].nitproveedor);
            $('#direccionedit').val(data[0].direccionproveedor);
            $('#id_proveedor').val(data[0].id_proveedor);
            // $('#sede_id').val(data[0].id_sede);
    
           // console.log(data);
        });
        $('#modaleditarproveedor').modal('show');
    }
  
    function edicion(e){
        e.preventDefault();
  
        var formData = new FormData($("#proveedor_form_edit")[0]);
  
       // alert('vv');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"proveedor/edicion",
          type:"POST",
          data: formData,
          contentType:false,
          processData:false,
          success: function(e){
          // console.log(data);
           // alert('nada');
           $('#proveedor_form_edit')[0].reset();
           $('#tablaproveedor').DataTable().ajax.reload();
          //   $('#tick_titulo').val('');
            $('#modaleditarproveedor').modal('hide');
  
    
           toastr.warning('Proveedor editado exitosamente', 'Buen Trabajo',{timeOut: 3000})
          }
         
        
        });   
       // toastr.success('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
    
      
    
  init();