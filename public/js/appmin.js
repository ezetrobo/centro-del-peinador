/* FUNCION PARA EL HOVER DEL MENU */

$('.nav-link').hover(
  function(){ $(this).addClass('active') },
  function(){ $(this).removeClass('active') }
)

function isOdd(num) { return num % 2;}

/* FUNCION PARA AGREGAR Y SACAR Z-INDEX EN EL SLIDER FIXED DEL HOME */

$(window).scroll(function() {

    if ($(this).scrollTop() >= 0) {
        $('#carousel-home').css('z-index', '0');
    }
    if ($(this).scrollTop() <= 1200) {
        $('#carousel-home').css('z-index', '1');
    }
});


/* FUNCION PARA CAMBIAR EL ICONO DEL FILTRO DEL CATALOGO */

$(document).ready(function () {
    $('.collapse')
        .on('shown.bs.collapse', function() {
            $(this)
                .parent()
                .find(".icono-")
                .removeClass("icono-")
                .addClass("icono-1");
        })
        .on('hidden.bs.collapse', function() {
            $(this)
                .parent()
                .find(".icono-1")
                .removeClass("icono-1")
                .addClass("icono-");
        });


    $("#txt_searchTips").keypress(function(event) {
        if(event.which == 13){
            event.preventDefault();
            buscartips($("#txt_searchTips").val());
        }
    });

    $("#txt_searchEvento").keypress(function(event) {
        if(event.which == 13){
            event.preventDefault();
            buscarEventos($("#txt_searchEvento").val());
        }
    });

    $("#txt_searchEsmalte").keypress(function(event) {
        if(event.which == 13){
            event.preventDefault();
            buscarEsmalte($("#txt_searchEsmalte").val());
        }
    });


    $("#searchEsmalte").select2( {
        placeholder: "Nombre o número de esmalte",
        allowClear: true
    });

    $("#searchTintura").select2( {
        placeholder: "Select Country",
        allowClear: true
    });

    $("#searchEsmalte").change(function(event) {
        $('[data-producto="'+ $(this).val() +'"]').click();
        var aux = $('[data-producto="'+ $(this).val() +'"]').attr('data-id');
        
        $('.collapse').on('show.bs.collapse', function () {
            $('.collapse.show').each(function(){
                $(this).collapse('hide');
            });
        });
        
        $("#tipo"+aux).collapse('show');
    });

    $("#searchTintura").change(function(event) {
        $('[data-producto="'+ $(this).val() +'"]').click();
        var aux = $('[data-producto="'+ $(this).val() +'"]').attr('data-id');
        
        $('.collapse').on('show.bs.collapse', function () {
            $('.collapse.show').each(function(){
                $(this).collapse('hide');
            });
        });
        
        $("#tipo"+aux).collapse('show');
    });
    

});


function buscartips(xSearch){
    $.ajax({
        url: baseUrl + 'tips/buscarTips',
        type: 'POST',
        data: {
            xSearch: xSearch,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        $("#tips").html(response);
        $("#txt_searchTips").val('');
    })
    .fail(function(response) {
        console.log("error");
    });
}

function buscarEventos(xSearch){
    $.ajax({
        url: baseUrl + 'eventos/buscarEventos',
        type: 'POST',
        data: {
            xSearch: xSearch,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        $("#eventos").html(response);
        $("#txt_searchEvento").val('');
    })
    .fail(function() {
        console.log("error");
    });
}

function buscarEsmalte(xSearch){
    $.ajax({
        url: baseUrl + 'catalogo/buscador',
        type: 'POST',
        data: {
            xSearch: xSearch,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        $("#eventos").html(response);
        $("#txt_searchEvento").val('');
    })
    .fail(function() {
        console.log("error");
    });
}

/* FUNCION PARA EL FILTRO DE PRECIOS DEL CATALOGO */

(function() {
    var parent = document.querySelector(".price-slider");
    if(!parent) return;
    
    var
      rangeS = parent.querySelectorAll("input[type=range]"),
      numberS = parent.querySelectorAll("input[type=number]");
    
    rangeS.forEach(function(el) {
      el.oninput = function() {
        var slide1 = parseFloat(rangeS[0].value),
              slide2 = parseFloat(rangeS[1].value);
    
        if (slide1 > slide2) {
          [slide1, slide2] = [slide2, slide1];
        }
    
        numberS[0].value = slide1;
        numberS[1].value = slide2;
      }
    });
    
    numberS.forEach(function(el) {
      el.oninput = function() {
          var number1 = parseFloat(numberS[0].value),
          number2 = parseFloat(numberS[1].value);
          
        if (number1 > number2) {
          var tmp = number1;
          numberS[0].value = number2;
          numberS[1].value = tmp;
        }
    
        rangeS[0].value = number1;
        rangeS[1].value = number2;
    
      }
    });
    
  })();


  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

/* FUNCIÓN PARA EL FILTRO DE ORDENAR POR: EN LA SECCIÓN CATALOGO */
$(function () {
  $('select').selectpicker();
});

/* FUNCIÓN PARA SUMAR Y RESTAR PRODUCTOS EN EL INPUT TIPO NUMERO */
$(document).ready(function(){
   
});



/* FUNCION PARA CERRAR LOS COLLAPSE CUANDO ABRE UNO */
$(document).ready(function($) {
    var alterClass = function() {
        var vv = document.body.clientWidth;
        
        if (vv < 480) {
            $('#atributo-prod, #descripcion-prod').addClass('collapse');
        } else if (vv >= 481) {
            $('#atributo-prod, #descripcion-prod').removeClass('collapse');
        };
    };

    $(window).resize(function(){
        alterClass();
    });
    
    alterClass();
});


 
/* FUNCIÓN PARA EL BOTON "GO TOP" */
var btn = $('#go-top');

$(window).scroll(function() {
  if ($(window).scrollTop() > 100) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


/* FUNCIÓN PARA AGREGAR LA CLASE ACTIVE A EL FILTRO DE COLORES */

$(function() {                       
    $(".btn-change-producto").click(function() { 
        /* Quitamos la clase active y los valores de los campos */
        $(".btn-change-producto").removeClass('active')
        $(".span_color").html('');
        $(".span_codigo").html('');
        $(".span_stock").html('');
        $('.agregar-carrito').attr("data-id", 0);
        
        $(this).addClass("active");      
    });
});


(function() {
  $('.toggle-wrap').on('click', function() {
    $(this).toggleClass('active');
    $('.buscador-tipo').animate({width: 'toggle'}, 200);
    $('#categorias').animate({width: 'toggle'}, 200);
  });
  $('.button-filtro').on('click', function() {
    $(this).toggleClass('active');
    $('#filtros').animate({width: 'toggle'}, 200);
  });
  $('.button-orden').on('click', function() {
    $(this).toggleClass('active');
    $('#orden').animate({width: 'toggle'}, 200);
  });
  $('.navbar-toggler').on('click', function() {
    $(this).toggleClass('active');
    $('#menu-md').animate({width: 'toggle'}, 200);
  });
})();





  /* Agregar producto al carro */


function resize() {
  if ($(window).width() < 514) {
    $('.tipo a').attr('data-toggle','');
  }
  else {
    $('.tipo a').attr('data-toggle','collapse');
  }
}

$(document).ready( function() {
  $(window).resize(resize);
  resize();
});


(function(){
 
  
  
})();



function eventos(xMes,$xAño){
    alert(xAño)
  $.ajax({
    url: baseUrl + '/eventos/eventosPasados',
    type: 'POST',
    dataType: 'JSON',
    data: {
        xMes: xMes,
        xAño : xAño
    },
  })
  .done(function() {

  })
  .fail(function() {
    console.log("error");
  });
  
}