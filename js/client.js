//при написинаии было использовано все кроме мозга :з
var form = document.querySelector('.validate_form');
var validateButton = document.querySelector('.validate_button');
var resetButton = document.querySelector('.reset_button');
var x = document.querySelector('.x');
var y = document.querySelector('.y');
var all_r = document.querySelectorAll('.r');
var R;

function isEmpty(val){
	let txt = val.value;
	if(txt == ''){
		alert('Field Y is empty!');
    return false;
	}	
}

$(document).ready(function(){

  $.ajax({
    url: 'php/load.php',
    method: "POST",
    dataType: "html",
    success: function(data){
      console.log(data);
      $("#results>tbody").html(data);
    },
    error: function(error){
      console.log(error);	
    },
  })
});

$(document).ready(function(){

  $("#info").on("submit", function(event){
    event.preventDefault();

    console.log("Recived values:");
    console.log('x:', x.value);
    console.log('y:', y.value);

    if(isEmpty(y)==false)
      return;

    for (var fr of all_r) {
      if (fr.checked) {
        console.log('R:', fr.value)
        R = fr;
      }    
    }

    console.log($(this).serialize());

    $.ajax({
        url: 'php/server.php',
        method: "GET",
        data: $(this).serialize() + "&timezone=" + new Date().getTimezoneOffset(),
        dataType: "html",

          success: function(msg){
            console.log("Data recived, s");
            console.log(msg);	
            $("#results>tbody").html(msg); 
          },
          error: function(error){
            console.log("Data recive error");
            console.log(error);
          $(".validate_button").attr("disabled", false);	
        },
    }) 
  });
});

$(".reset_button").on("click",function(){
  $.ajax({
    url: 'php/reset.php',
    method: "POST",
    dataType: "html",
    success: function(data){
      console.log(data);
      $("#result_table>tbody").html(data);
    },
    error: function(error){
      console.log(error);	
    },
  })
})











