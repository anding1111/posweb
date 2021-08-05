$(document).ready(function () {
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
       isClosed = false;
  
      trigger.click(function () {
        hamburger_cross();      
      });
  
      function hamburger_cross() {
  
        if (isClosed == true) {          
          overlay.hide();
          trigger.removeClass('is-open');
          trigger.addClass('is-closed');
          isClosed = false;
        } else {   
          overlay.show();
          trigger.removeClass('is-closed');
          trigger.addClass('is-open');
          isClosed = true;
        }
    }
    
    $('[data-toggle="offcanvas"]').click(function () {
          $('#wrapper').toggleClass('toggled');
    });  
  });

  // JS Alert Custom
  var janelaPopUp = new Object();
  janelaPopUp.abre = function(id, classes, titulo, corpo, functionCancelar, functionEnviar, textoCancelar, textoEnviar){
      var cancelar = (textoCancelar !== undefined)? textoCancelar: 'OK';
      var enviar = (textoEnviar !== undefined)? textoEnviar: 'Continuar';
      classes += ' ';
      var classArray = classes.split(' ');
      classes = '';
      classesFundo = '';
      var classBot = '';
      $.each(classArray, function(index, value){
          switch(value){
              case 'alert' : classBot += ' alert '; break;
              case 'blue' : classesFundo += this + ' ';
              case 'green' : classesFundo += this + ' ';
              case 'red' : classesFundo += this + ' ';
              case 'white': classesFundo += this + ' ';
              case 'orange': classesFundo += this + ' ';
              case 'purple': classesFundo += this + ' ';
              default : classes += this + ' '; break;
          }
      });
      var popFundo = '<div id="popFundo_' + id + '" class="popUpFundo ' + classesFundo + '"></div>'
      var janela = '<div id="' + id + '" class="popUp ' + classes + '"><h1>' + titulo + "</h1><div><span>" + corpo + "</span></div><button class='puCancelar " + classBot + "' id='" + id +"_cancelar' data-parent=" + id + ">" + cancelar + "</button><button class='puEnviar " + classBot + "' data-parent=" + id + " id='" + id +"_enviar'>" + enviar + "</button></div>";
      $("window, body").css('overflow', 'hidden');
      
      $("body").append(popFundo);
      $("body").append(janela);
      $("body").append(popFundo);
      $("#popFundo_" + id).fadeIn("fast");
      $("#" + id).addClass("popUpEntrada");
      
      $("#" + id + '_cancelar').on("click", function(){
          if((functionCancelar !== undefined) && (functionCancelar !== '')){
              functionCancelar();
              
          }else{
              janelaPopUp.fecha(id);
          }
      });
      $("#" + id + '_enviar').on("click", function(){
          if((functionEnviar !== undefined) && (functionEnviar !== '')){
              functionEnviar();
          }else{
              janelaPopUp.fecha(id);
          }
      });
      
  };
  janelaPopUp.fecha = function(id){
      if(id !== undefined){
          $("#" + id).removeClass("popUpEntrada").addClass("popUpSaida"); 
          
              $("#popFundo_" + id).fadeOut(1000, function(){
                  $("#popFundo_" + id).remove();
                  $("#" + $(this).attr("id") + ", #" + id).remove();
                  if (!($(".popUp")[0])){
                      $("window, body").css('overflow', 'auto');
                  }
              });
              
        
      }
      else{
          $(".popUp").removeClass("popUpEntrada").addClass("popUpSaida"); 
          
              $(".popUpFundo").fadeOut(1000, function(){
                  $(".popUpFundo").remove();
                  $(".popUp").remove();
                  $("window, body").css('overflow', 'auto');
              });
              
         
      }
  }

  var close = document.getElementsByClassName("closebtn");
  var i;
  
  for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
      var div = this.parentElement;
      div.style.opacity = "0";
      setTimeout(function(){ div.style.display = "none"; }, 600);
    }
  }

//   $("#button-popUp").on("click", function(){
//     var myText = $("#myText").val();
//     janelaPopUp.abre( "asdf", $("#size").val() + " "  + $(this).html() + ' ' + $("#mode").val(),  $("#title").val() ,  myText)
//   });
//   janelaPopUp.abre( "example", 'p red',  'Example' ,  'chosse a configuration and click the color!');
//   setTimeout(function(){janelaPopUp.fecha('example');}, 2000);
  