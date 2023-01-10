   
// Manage Product ==============================================================

function CheckUnit(val){
  var element=document.getElementById('units');
    if(val=='Others')
      element.style.display='block';
    else  
      element.style.display='none';
    
    $('#form_id').submit(function() {
          var othersOption = $('#unit').find('option:selected');
          if(othersOption.val() == "Others")
          {
              // replace select value with text field value
              othersOption.val($("#units").val());
          }
      });
}

function myFunction() {
  var x = document.getElementById("units");
  if (x.style.display === "block") {
    x.style.display = "none";
    $("#unit").val($("#unit option:first").val());
  }
}


function CheckUpdateUnit(val){
  var element=document.getElementById('update_units');
    if(val=='Others')
      element.style.display='block';
    else  
      element.style.display='none';

    $('#form_id2').submit(function() {
          var othersOption = $('#update_unit').find('option:selected');
          if(othersOption.val() == "Others")
          {
              // replace select value with text field value
              othersOption.val($("#update_units").val());
          }
      });
}

function myFunctionn() {
  var x = document.getElementById("update_units");
  if (x.style.display === "block") {
    x.style.display = "none";
    $("#update_unit").val($("#update_unit option:first").val());
  }
}





    