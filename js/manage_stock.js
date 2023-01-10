// Manage Stock ==============================================================

function CheckReason(val){
    var element=document.getElementById('reasons');
      if(val=='Others')
        element.style.display='block';
      else  
        element.style.display='none';
      
      $('#form_id').submit(function() {
            var othersOption = $('#reason').find('option:selected');
            if(othersOption.val() == "Others")
            {
                // replace select value with text field value
                othersOption.val($("#reasons").val());
            }
        });
  }

  function myFunction() {
    var x = document.getElementById("reasons");
    if (x.style.display === "block") {
      x.style.display = "none";
      $("#reason").val($("#reason option:first").val());
    }
  }


  function CheckReason2(val){
    var element=document.getElementById('reasons2');
      if(val=='Others')
        element.style.display='block';
      else  
        element.style.display='none';
      
      $('#form_id2').submit(function() {
            var othersOption = $('#reason2').find('option:selected');
            if(othersOption.val() == "Others")
            {
                // replace select value with text field value
                othersOption.val($("#reasons2").val());
            }
        });
  }

  function myFunction2() {
    var x = document.getElementById("reasons2");
    if (x.style.display === "block") {
      x.style.display = "none";
      $("#reason2").val($("#reason2 option:first").val());
    }
  }