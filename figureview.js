function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

 $(document).ready( function() {   
    
    $(document).on('click', 'input[name="ownorwant"]', function(){
    if($(this).val() == 'Own'){
        $(this).closest('.grid-container5').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container5').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container5').find('.block2').empty();
    }else {
        $(this).closest('.grid-container5').find('.hidecarded').removeClass( 'hidecarded' )
        $(this).closest('.grid-container5').find('.hideloose').removeClass( 'hideloose' )
        $(this).closest('.grid-container5').find('.block1').empty();
    }
});
 
$(document).on('click', 'input[name="packaging"]', function(){
    if($(this).val() == 'Loose'){
        $(this).closest('.grid-container5').find('.hidecomplete').removeClass( 'hidecomplete' )
        $(this).closest('.grid-container5').find('.hideincomplete').removeClass( 'hideincomplete' )
        $(this).closest('.grid-container5').find('.block4').empty();
    }else{
        $(this).closest('.grid-container5').find('.hidepunched').removeClass( 'hidepunched' )
        $(this).closest('.grid-container5').find('.hideunpunched').removeClass( 'hideunpunched' )
        $(this).closest('.grid-container5').find('.field20').css({"grid-area": "5 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field21').css({"grid-area": "5 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field16').css({"grid-area": "6 / 4 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field17').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.block3').empty();
    }
});

$(document).on('click', 'input[name="accessories"]', function(){
    if($(this).val() == 'Complete'){
        $(this).closest('.grid-container5').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container5').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.block6').empty();
    }else{
        $(this).closest('.grid-container5').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container5').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field21').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.block5').empty();
    }
});

$(document).on('click', 'input[name="hanger"]', function(){
    if($(this).val() == 'Punched'){
        $(this).closest('.grid-container5').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container5').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.block8').empty();
    }else{
        $(this).closest('.grid-container5').find('.save').removeClass( 'save' )
        $(this).closest('.grid-container5').find('.field25').css({"grid-area": "6 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.field17').css({"grid-area": "7 / 5 / span 1 / span 1"})
        $(this).closest('.grid-container5').find('.block7').empty();
    }
}); 

$(document).ready(function() {
  //toggle the component with class accordion_body
  
  $(".grid-container3").hide();
 
  $(".grid-container2").click(function() {
            $(this).prevAll(".grid-container3").slideUp(300);
            $(this).nextAll(".grid-container3").slideUp(300);
            $(".plusminus2").text('Show (+)');
            $(".plusminus3").text('(+)');

        if ($(this).next(".grid-container3").is(':visible')) {
            $(this).next(".grid-container3").slideUp(300);
            $(this).nextAll(".grid-container4").slideUp(300);
            $(this).nextAll(".grid-container5").slideUp(300);
            $(".plusminus2").text('Show (+)');
            $(".plusminus3").text('(+)');
        } 
        
        else {
           $(this).nextUntil(".grid-container2").slideDown(300);
           $(".grid-container4").hide();
           $(".grid-container5").hide();
           $(this).find(".plusminus2").text('Hide (-)');
    }
  });
});

$(document).ready(function() {
    $(".grid-container4").hide();
    $(".grid-container5").hide();

    $(".grid-container3").click(function() {
            $(this).nextUntil(".grid-container2").slideUp(300);
            $(".plusminus3").text('(+)');
            $(".plusminus4").text('(+)');
          

        if ($(this).next('.grid-container4').is(':visible')) {
            $(".grid-container4").slideUp(300)
            $(".plusminus3").text('(+)');
            $(".plusminus4").text('(+)');
            $(this).find(".plusminus2").text('Hide (-)');
        }

        if ($(this).next(".grid-container4").is(':visible')) {
            $(this).next(".grid-container4").slideUp(300);
            $(".plusminus3").text('(+)');
            $(this).find(".plusminus2").text('Hide (-)');
        } 
        
        else {
           $(this).nextUntil(".grid-container2").slideDown(300);
           $(".grid-container5").hide();
           $(this).find(".plusminus3").text('(-)');
    }
  });
});



$(document).ready(function() {
  
  
  $(".grid-container4").click(function() {
        



        if ($('.grid-container5').is(':visible')) {
            $(".grid-container5").slideUp(300)
            $(".plusminus1").text('Show (+)');
            $(".plusminus4").text('Show (+)');
        }
        if ($(this).next(".grid-container5").is(':visible')) {
            $(this).next(".grid-container5").slideUp(300);
            $(".plusminus1").text('Show (+)');
            $(".plusminus4").text('Show (+)');
            
        } else {
           $(this).next(".grid-container5").slideDown(300);
           $(this).find(".plusminus1").text('Hide (-)');
           $(this).find(".plusminus4").text('Hide (-)');
    }
  });
});


   


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

  $('#loadingMask').fadeOut();
});


function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
