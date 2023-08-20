function init(){

}

$(document).ready(function(){
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