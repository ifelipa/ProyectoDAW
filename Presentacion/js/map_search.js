$(function () {
    //pone el foco en el input de la barra de busqueda
   // $('#search-input').focus();

    //verifica si el valor del usuario esta o no registrado
    //para implementar bien la ruta de la llamada ajax
    //el valor de data-user esta declarado en el formulario del buscador
    var route = $('form#search').attr('data-user');
    var loading = '';
    var image = '';
    if (route == "true") {
        route = '../../Logica/searchController.php';
        loading = '<h4><img src="../img/loading.gif" width="50" alt="" /> Loading...</h4>';

    } else {
        route = '../Logica/searchController.php';
        loading = '<h4><img src="img/loading.gif" width="50" alt="" /> Loading...</h4>';
    }

    //BUSCADOR



    $('#search').keyup(function () {
        var data = $('#search-input').val();
        $('#result-wrapper').html(loading);

            //si quiere buscar por Nombre de ER
        if (data != '') {
            $.ajax({
                type: 'POST',
                url: route,
                data: ('dataSearch=' + data),
                success: function (resp) {
                    if (resp != "") {
                        $('#result-wrapper').html(resp);
                    } else if (resp.length == 0) {
                        $('#result-wrapper').html('<h4> <strong>No results found</strong></h4>');
                    }
                },
                error: function (errorThrown) {
                    $('#result-wrapper').html('<h4> <strong> No results found </strong></h4>');
                }
            })
        }
    });

    //ver todos los ER

    $(".viewall_checkbox").change(function() {
        if(this.checked) {
            var req = '';
            $.ajax({
                type: 'POST',
                url: route,
                data: ('dataSearch=' + req),
                success: function (resp) {
                    if (resp != "") {
                        $('#result-wrapper').html(resp);
                    }
                }
            })
        }else{
            $('#result-wrapper').html(" ");
        }
    });


    //BUSCADOR MAPA

    $('#input-search-map').keyup(function () {
        var data = $('#input-search-map').val();
        if (data != '') {
            $.ajax({
                type: 'POST',
                url: '../../Logica/searchController.php',
                data: ('mapSearch=' + data),
                dataType: "json",
                success: function (resp) {
                    if (resp != "") {
                        var escape = resp[0].split(";");
                        var in_html = "<h4><strong>" + escape[0] + "</strong></h4><br>" +
                            "<p>" + escape[1] + "</p> <br>" +
                            "<p>" + escape[2] + "</p> <br>";
                        var street = escape[1] + ", Barcelona";
                        createPoint(street);
                        $('#result-map').html(in_html);
                    } else if (resp.length == 0) {
                        $('#result-map').html('<h4> <strong>No results found</strong></h4>');
                    }
                },
                error: function (errorThrown) {
                    $('#result-map').html('<h4> <strong> No results found </strong></h4>');
                }
            })
        } else {
            $('#result-map').html('<h4> <strong>No results found</strong></h4>');
        }
    })


    //BUSCADOR MAPA TODOS

    $('#allMap').change(function () {
        if (this.checked) {
            var data = '*';
            $.ajax({
                type: 'POST',
                url: '../../Logica/searchController.php',
                data: ('mapSearchAll=' + data),
                dataType: "json",
                success: function (resp) {
                    console.log(resp);
                    var arrPos = arrayPostion(resp);
                    setPoint(arrPos);

                }
            })
        }
    })


}) //End jquery ready


//create number of markers based on collection.length
function setPoint(point) {
    var pointMarkerImage = new Array();//store image of marker in array
    var pointMarker = new Array();//store marker in array
    for (var i = 0; i < point.length; i++) {

        pointMarkerImage[i] = new google.maps.MarkerImage('marker.png');
        pointMarker[i] = new google.maps.Marker({
            position: point[i],
            map: map,
            icon: pointMarkerImage[i],
            animation: google.maps.Animation.BOUNCE,
            title: "collection" + i
        });

        google.maps.event.addListener(pointMarker[i], 'click', function () {
                window.open("blog/page01.html", "_blank", "toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes, copyhistory=yes");
            }
        );
    }
}
/*
 Funcion que crea un array de Posiciones ER

 */
function arrayPostion(arg) {
    var posER = [];
    for (var i = 0; i < arg.length; i++) {
        var escape = arg[i].split(";");
        var street = escape[1] + ", Barcelona";
        posER[i] = addressLatLng(street);
    }
    return posER;
}
/**
 * Funcion que retorna latitud y longitud de una direccion
 */
function addressLatLng(arg) {
    var point = '';
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({address: arg}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            point = results[0].geometry.location; // reference LatLng value
        }
    });
    return point;
}

/*
 FUNCION CREATEPOINT
 crea las localizaciones en el mapa
 de acuerdo a la direccion del ER
 */
function createPoint(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, geocodeResult);

}

function geocodeResult(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
        // Si hay resultados encontrados, centramos y repintamos el mapa
        // esto para eliminar cualquier pin antes puesto
        var mapOptions = {
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($("#googleMap").get(0), mapOptions);
        // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
        map.fitBounds(results[0].geometry.viewport);
        // Dibujamos un marcador con la ubicación del primer resultado obtenido
        var markerOptions = {position: results[0].geometry.location}

        var marker = new google.maps.Marker(markerOptions);
        marker.setMap(map);
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        alert('Geocode was not successful for the following reason: ' + status);
    }

}


function initMap() {
    var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 8,
        center: {lat: 41.3850639, lng: 2.1734034999999494}
    });
}