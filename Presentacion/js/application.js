$(function () {

    /*VALIDATOR ADD NEW USER*/
    $('#addNewUser').find(':input').focusout(function () {
        var values = $(this).val();
        var name = $(this).attr('name');
        var myID = '#' + $(this).attr('id');

        if (name == 'name' || name == 'surname') {
            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else if (valText(values) == 3) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }
        } else if (name == 'username') {
            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }
        } else if (name == 'password') {
            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }

        } else if (name == 'email') {
            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else if (!valEMail(values)) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }
        } else if (name == 'phone') {

            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else if (!valTelefono(values)) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }
        } else if (name == 'zip_code') {
            if (valText(values) == 1 || valText(values) == 2) {
                resaltarErr(myID);
            } else if (!valCP(values)) {
                resaltarErr(myID);
            } else {
                resaltarBien(myID);
            }
        }
    });




        /*************ERUSER********************/

    //Carga inicial del er seleccionado
    var er_selected = $('#listER_reservations').find('option:selected').val();
    loadReservations(er_selected);
    parkingLoad();

    //si se produce un cambio en la lista de ER se modificará
    // el calendario donde se ve las fechas y horas que ya estan rerservas

    $('select#listER_reservations').change(function () {
        er_selected = $('#listER_reservations').find('option:selected').val();
        loadReservations(er_selected);
        //comprobando que este activado el checkbox de parking
        if ($("#hasparking").is(':checked')) {
            parkingLoad();
        }
    });


    /*cuando el usuario además de reservar un ER quiere registrar
     * un parking se activa el formulario de parking, mostrando los parking
     * disponibles para el ER seleccionado
     */
    $("#hasparking").click(function () {
        if ($("#hasparking").is(':checked')) {
            $('#park-available').css('display', 'block');
        } else {
            $('#park-available').css('display', 'none');
        }
    });
    
    
    
    /**************Google Analytics*****************/

    //registra los click en el input del buscador
    $('#search-input').on('click',function(){
        ga('send', 'event', 'searchinput', 'click', 'click input search');
    });

    //registra cuando clickan para loguearse
    $('#nav-bar-ThEscape > ul > li > a').on('click',function(){
        ga('send', 'event', 'login', 'click', 'click input search');
    });
 //registra los click para ingresar
    $('#login-nav > button').on('click',function(){
        ga('send', 'event', 'signin', 'click', 'click input search');
    });
    
 //registra los click de los usuarios que buscan todos
    $('body > div > div.search-wrapper > div.col-md-4.col-sm-8.col-xs-12.viewall').on('click',function(){
        ga('send', 'event', 'viewall', 'click', 'click input search');
    });
 //registra los click en el input del buscador por mapa
    $(' #input-search-map').on('click',function(){
        ga('send', 'event', 'searchmap', 'click', 'click input search');
    });


});//end jquery


/*carga inicial de parking*/

function parkingLoad() {
    var er_selected = $('#listER_reservations').find('option:selected').val();
    $.ajax({
        type: 'POST',
        url: '../../Logica/controller.php',
        data: ('dataParking=' + er_selected),
        success: function (resp) {
            if (resp != "") {
                $('#listParking').html(resp);
            }
        }
    })
}


/*
 Function que se encarga de mostrar el calendario con las fechas
 que ya tienen reserva
 */
function loadReservations(arg) {
    //recoge el valor del escape room seleccionado

    if (arg != '') {
        $.ajax({
            type: 'POST',
            url: '../../Logica/searchController.php',
            data: ('loadDateReservations=' + arg),
            dataType: "json",
            success: function (resp) {
                if (resp != " ") {
                    var in_html = '';
                    for(var i=0 ; i<resp.length; i++){
                        //separamos fechas
                        var date = resp[i].split('/');
                        for(var j=0 ; j<1; j++){
                            var hour = date[j].split(';');
                            in_html+='<div class="data_date_busy col-md-4 col-xs-6" > <p> <strong>Day : </strong>'+ hour[0]+'<br> <strong>Hour : </strong>' + hour[1] + '</p> </div>';
                        }
                    }

                    $('#calendar_availability').html(in_html);
                }
            },
            error: function(errorThrown){
                $('#calendar_availability').html('<h4> <strong> No results found </strong></h4>');
            }
        })
    }
}


/**FUNCIONES QUE VALIDAN LOS CAMPOS*/

function resaltarErr(obj) {
    $(obj).css("border", "2px solid red");
    $(obj).focus();
}

function resaltarBien(obj) {
    $(obj).css("border", "2px solid #F0AD4E");
}

function valFecha(value) {
    return (/^\d{2}\/\d{2}\/\d{4}$/.test(value));
}

function valCP(value) {
    return (/(^([0-9]{5,5})|^)$/.test(value));
}

function valTelefono(value) {
    return ((/[0-9]{9}/).test(value));
}

function valEMail(value) {
    return (/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.test(value))
}

function valText(value) {
    if (value.length < 0) {
        return 1;
    } else if (/^\s+$/.test(value)) {
        return 2;
    } else if (!isNaN(value)) {
        return 3;
    }
    return 0;
}

   
