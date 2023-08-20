function init(){

  }

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
  $.ajaxSetup({
  headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
  });
  
  $(document).on("click","#btnrepventas",function(){
  
    $('#modalreporteventas').modal('show');
    
});

$(document).on("click","#btnrepventasdown",function(){
  
reporteventas();
    
});

$(document).on("click","#btnrepproddown",function(){
  
    reporteproducto();
        
    });
    

function reporteproducto(){
    Swal.fire({
        title: 'Espere un momento !',
        type: 'info',
        html: 'El reporte se esta generando',// add html attribute if you want or remove
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    $.ajax({url:'rproductoindex',         xhrFields: {
        responseType: 'blob'
    }}).done(function(e){

        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Productos.pdf";
                                        link.click();
                                        swal.close();
                            
        // $('#sede_id').val(data[0].id_sede);

       // console.log(data);
    });
}

function reporteventas()
{
    var fechai = $('#f_iniciorep').val();
    var fechaf = $('#f_finalrep').val();
    Swal.fire({
        title: 'Espere un momento !',
        type: 'info',
        html: 'El reporte se esta generando',// add html attribute if you want or remove
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    $.ajax({url:'rventasindex/'+fechai+'/'+fechaf,         xhrFields: {
        responseType: 'blob'
    }}).done(function(e){

        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Ventas.pdf";
                                        link.click();
                                        swal.close();
                                        $('#modalreporteventas').modal('hide');
        // $('#sede_id').val(data[0].id_sede);

       // console.log(data);
    });

}

init();