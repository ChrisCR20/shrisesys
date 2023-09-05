function init(){
    $("#sucursal_form").on("submit",function(e)
    {
      guardar(e);
    });

    $("#sucursal_form_edit").on("submit",function(e)
    {
     edicion(e);
    });
  }

 
  $(document).ready(function(){

    // $('#id_empresa').select2();
    // $('#id_empresac').select2();

    $('#tablasucursal').DataTable({
        "responsive": false,
        "autoWidth": false,
       "searching": true,
       "lengthChange": true,
        "ajax":{
            url:'indexsucursal',
            type: "get",
            dataType: "json",
        },
        columns :[
            {
                data:'id_sucursal',
                name:'id_sucursal'
            },
            {
                data:'nombresucursal',
                name:'nombresucursal'
            },
            {
                data:'direccionsucursal',
                name:'direccionsucursal'
            },
            {
                data:'nombre_empresa',
                name:'nombre_empresa'
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
  
  
  
  $(document).on("click","#btnnuevasucursal",function(){
  
      $('#modalnuevasucursal').modal('show');

  });
  $(document).on("click","#btneditarempresa",function(){
  
    

});
  function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData($("#sucursal_form")[0]);
      
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"sucursal/ingreso",
        type:"POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(e){
        // console.log(data);
         // alert('nada');
         $('#sucursal_form')[0].reset();
         $('#tablasucursal').DataTable().ajax.reload();
        //   $('#tick_titulo').val('');
          $('#modalnuevasucursal').modal('hide');

  
          toastr.success('Sucursal agregada exitosamente', 'Buen Trabajo',{timeOut: 2000})
        }
       
      
      });
      
    }
    function editar(id_sucursal){
        var idsucursal = id_sucursal;
        $.ajax({url:'sucursal/obtener/'+idsucursal}).done(function(data){
            console.log(data[0].nombresucursal);
            $('#nombre_sucursaledit').val(data[0].nombresucursal);
            $('#direccionedit').val(data[0].direccionsucursal);
            $('#id_sucursal').val(data[0].id_sucursal);
            // $("#id_empresa").val('1').trigger('change');
            // $('#sede_id').val(data[0].id_sede);
            if ($('#id_empresa').find("option[value='" + data[0].id_empresa + "']").length)
            { console.log('chile');$('#id_empresa').select2().val(data[0].id_empresa).trigger('change'); }


  

    
           // console.log(data);
        });
        $('#modaleditarsucursal').modal('show');
    }

    function edicion(e){
        e.preventDefault();
  
        var formData = new FormData($("#sucursal_form_edit")[0]);

       // alert('vv');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url:"sucursal/edicion",
          type:"POST",
          data: formData,
          contentType:false,
          processData:false,
          success: function(e){
          // console.log(data);
           // alert('nada');
           $('#sucursal_form_edit')[0].reset();
           $('#tablasucursal').DataTable().ajax.reload();
          //   $('#tick_titulo').val('');
            $('#modaleditarsucursal').modal('hide');
  
    
           toastr.warning('Scursal editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
         
        
        });   
       // toastr.success('Empresa editada exitosamente', 'Buen Trabajo',{timeOut: 2000})
          }
    
      
    
  init();