function init(){
    $("#form_aperturac").on("submit",function(e)
    {
      guardar(e);
    });
  
    $("#form_cierrec").on("submit",function(e)
    {
      cerrarcaja(e);
    });

  }
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
  $.ajaxSetup({
  headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });

  $(document).ready(function(){

    estado= $('#estado').val();
    console.log(estado);
    if(estado==1)
    {
      Swal.fire({
        type: 'info',
        title: 'No se puede aperturar caja',
        text: 'Debes hacer el cierre de caja primero!'
      }).then((result) => {
        location.href = "/";
      })
    }

    if(estado==3)
    {
      Swal.fire({
        type: 'info',
        title: 'No se puede cerrar caja',
        text: 'Debes aperturar de caja primero!'
      }).then((result) => {
        location.href = "/";
      })
    }

  

});

function guardar(e) {
      e.preventDefault();
  
      var formData = new FormData($("#form_aperturac")[0]);
      
        console.log(formData);

          Swal.fire({
            title: 'Aperturar caja?',
            text: "Una vez enviada la transaccion no se podra revertir",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Enviada',
                    'La caja fue aperturada',
                    'success'
                  ).then((result) => {
                    if (result.value) {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                      url:"caja/ingreso",
                      type:"POST",
                      data: formData,
                      contentType:false,
                      processData:false,
                      success: function(e){
              
                       $('#form_aperturac')[0].reset();
                       location.href = "/";
                      }
                     
                    
                    });
                    }
                  })
                  
            }
          })

    }

    function cerrarcaja(e) {
      e.preventDefault();
  
      var formData = new FormData($("#form_cierrec")[0]);
      
        console.log(formData);

          Swal.fire({
            title: 'Cerrar caja?',
            text: "Una vez enviada la transaccion no se podra revertir",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Enviada',
                    'La caja fue cerrada correctamente',
                    'success'
                  ).then((result) => {
                    if (result.value) {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                      url:"caja/cierrecaja",
                      type:"POST",
                      data: formData,
                      contentType:false,
                      processData:false,
                      success: function(e){
              
                       $('#form_cierrec')[0].reset();
                       location.href = "/";
                      }
                     
                    
                    });
                    }
                  })
                  
            }
          })

    }

      
    
  init();