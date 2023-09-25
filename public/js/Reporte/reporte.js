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
  
    $('#modalpresentacion').modal('show');
   // reporteproducto();
        
    });
    $(document).on("click","#btnexistencia",function(){
  
        reporteproducto();
            
        });

    $(document).on("click","#btnrepbajaexis",function(){
  
        reportebajaexistencia();
            
        });

$(document).on("click","#btnrepmasvendidos",function(){
  
reportemasvendidos();
                
});
    

function reporteproducto(){
    var idmedida = $('#idmedida').val();

    Swal.fire({
        title: 'Espere un momento !',
        type: 'info',
        html: 'El reporte se esta generando',// add html attribute if you want or remove
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    $.ajax({url:'rproductoindex/'+idmedida,         xhrFields: {
        responseType: 'blob'
    }}).done(function(e){
        var date = new Date();
        var dater=date.getFullYear()+'s'+date.getMinutes()+date.getSeconds();
        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Productos-"+dater+".pdf";
                                        link.click();
                                        swal.close();
                            
        // $('#sede_id').val(data[0].id_sede);

       // console.log(data);
    });
}

function reportebajaexistencia(){
    Swal.fire({
        title: 'Espere un momento !',
        type: 'info',
        html: 'El reporte se esta generando',// add html attribute if you want or remove
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    $.ajax({url:'rbajaexistencia',         xhrFields: {
        responseType: 'blob'
    }}).done(function(e){
        var date = new Date();
        var dater=date.getFullYear()+'s'+date.getMinutes()+date.getSeconds();
        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "BajaExistencia-"+dater+".pdf";
                                        link.click();
                                        swal.close();
                            
        // $('#sede_id').val(data[0].id_sede);

       // console.log(data);
    });
}

function reportemasvendidos(){
    Swal.fire({
        title: 'Espere un momento !',
        type: 'info',
        html: 'El reporte se esta generando',// add html attribute if you want or remove
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    $.ajax({url:'masvendidos',         xhrFields: {
        responseType: 'blob'
    }}).done(function(e){
        var date = new Date();
        var dater=date.getFullYear()+'s'+date.getMinutes()+date.getSeconds();
        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "15masVendidos-"+dater+".pdf";
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
        var date = new Date();
        var dater=date.getFullYear()+'s'+date.getMinutes()+date.getSeconds();
        var blob = new Blob([e]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Ventas-"+dater+".pdf";
                                        link.click();
                                        swal.close();
                                        $('#modalreporteventas').modal('hide');
        // $('#sede_id').val(data[0].id_sede);

       // console.log(data);
    });

}

init();