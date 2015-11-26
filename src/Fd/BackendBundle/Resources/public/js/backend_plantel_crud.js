/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

            //cargas iniciales de datos
            cargar_organizaciones();

            $('#backend_plantelestablecimiento_type_establecimiento').change(function () {
                cargar_organizaciones();
            });
        });

        function cargar_organizaciones() {

            $("#divCargando").show();
            var establecimiento = $("#backend_plantelestablecimiento_type_establecimiento").val();

            //esta forma es usando javascript puro
            //var lista = document.getElementById("cmb_establecimientos");
            //var clave = lista.options[lista.selectedIndex].value;

            //usando FOSJsRouingBundle
            $.ajax({
                async: false,
                dataType: 'html',
                url: Routing.generate('backend.organizacion_interna.por_establecimiento', {establecimiento_edificio_id: establecimiento}),
                type: 'GET',
                success: function (data) {
                    $("#backend_plantelestablecimiento_type_organizacion").html(data);
                },
            });

            $('#divCargando').hide();

        };



