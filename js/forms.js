$(document).ready(function () {
                        // Date Picker
                    $( function() {
                        $( ".datepicker" ).datepicker({
                            dateFormat: "yy-mm-dd",
                            yearRange: "c-100:c+0",
                            changeMonth: true,
                            changeYear: true
                        } );
                    } );

    $('.registration-form fieldset:first-child').fadeIn('slow');

    $('.registration-form input[type="text"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.registration-form .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

/*        parent_fieldset.find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });*/

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }

    });

    // previous step
    $('.registration-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    // submit
    $('.registration-form').on('submit', function (e) {

/*        $(this).find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });*/


    });

    

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').fadeIn();
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    var width = $(window).width(); 
    if (width >= 768  ) {
        
        $('#sidebar').addClass('active');
        $('#sidebarCollapse').css('display','none')

    } else {
        $('#sidebar').removeClass('active');
    }
 

   
});

//funcion manda a fullscreen en modo movil (small)
function goFullScreen() {
    var miElemento = $('#sidebarCollapse');
    var width = $(window).width(); 
    if (width <= 768  ) {
        //fullScreenApi.requestFullScreen(document.documentElement);
           $('.menuDinamico button, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').fadeOut();
            });
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').fadeIn();
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });



    }
    else {
        //do something else

    }

    if (miElemento.css('display') === 'inline-block') {
        
    }   
}
//con window.onload se envuelve el gestor de eventos, se ejecuta hasta que se carga totalmente el documento
//Es muy importante tener claro siempre el orden en el que se va ejecutar. 
//Otra alternativa a window.onload es poner el codigo al final del body.
window.onload = function(){
    // Al evento se le asigna la definición de la función. 
    //No la llamada de la función por eso no lleva (), si no se ejecutaria al momento de que se carga.
    document.getElementById("sidebarCollapse").onclick = goFullScreen ;


    var events = [
          {'Date': new Date(2018, 0, 7), 'Title': '<i class="fa fa-bicycle" aria-hidden="true"></i>'},
          {'Date': new Date(2018, 0, 18), 'Title': '<i class="fa fa-medkit" aria-hidden="true"></i><br><i class="fa fa-cutlery fa-fw"></i>', 'Link': 'http://www.google.com'},
          {'Date': new Date(2018, 0, 27), 'Title': '<i class="fa fa-cutlery fa-fw"></i><br><i class="fa fa-medkit" aria-hidden="true"></i><br><i class="fa fa-bicycle" aria-hidden="true"></i>', 'Link': 'http://www.google.com/'},
        ];
    var settings = {};
    var element = document.getElementById('caleandar');
    caleandar(element, events, settings);
}

    // Script to open and close sidebar
      function w3_open() {
/*        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";*/
      }
      
      function w3_close() {
/*        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";*/
      }