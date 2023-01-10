function GrandTotal(){
    var TotalValue = 0;
    var TotalPriceArr = $('#tabledata tr .totalPrice').get()
    var discount = $('#discount').val();

    $(TotalPriceArr).each(function(){
      TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("₱",""));
    });
    
      if(discount != null){
    var f_discount = 0;

    var f_discount = parseFloat(TotalValue) * parseFloat(discount,10);

    console.log("xxxxxxxxx:", f_discount)

    var g_discount = parseFloat(TotalValue) - f_discount;
    
    $("#totalValue").text(accounting.formatMoney(g_discount,{symbol:"₱",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(g_discount,{format: "%v"}));
    $("#discounted").val(accounting.formatMoney(f_discount,{format: "%v"}));
  }else{
    $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"₱",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }
};

$(document).on('change', '#discount', function(){
    GrandTotal();
});

$('body').on('click','.discount',function(e){
    e.preventDefault();
    var discount = $('#discount').val();
    var discounted = $('#discounted').val();

    console.log("cancel:", discount)
    console.log("cancel:", discounted)
    

    var TotalPriceArr = $('#tabledata tr .totalPrice').get();

    if (TotalPriceArr == 0){
        swal("Warning","No Products Added!","warning");
        return false; 
    }else{
    swal({
        title:"Enter Discount (%):",
        content: "input",
        buttons: ["Cancel","Ok"],
      })
      .then((value) => {
          if (value == "") {
              swal("Error","Entered none!","error");
          }else if (value > 100) {
            swal("Error","Discount must 100% only!","error");
          }else if (value < 0) {
            swal("Error","Please enter a valid number!","error");
          }else{
            var qtynum = value;
          if (isNaN(qtynum)){
            swal("Error","Please enter a valid number!","error");
          }else if(qtynum == null){
            swal("Error","Please enter a number!","error");
          }else{
    
        console.log("cancel:", value)
        $('#discountpercent').val(value);
        $('#discount').val(parseInt(value,10) / 100);

        swal({
            title: "Discount added successfully!",
            icon: "success",
          })
          
        GrandTotal();
    }
        }
    });
  }
});

$(document).ready(function () {
  $("#example").DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        "scrollX": false,
        "zeroRecords": "No item/s added",
        stripeClasses: [],
  }); 
  $('body').on('click','.addbtn',function(e){
    
      e.preventDefault();
      var totalPrice = 0;
      var target = $(this);
      var product = target.attr('data-product');
      var brand = target.attr('data-brand');
      var price = target.attr('data-price');
      var product_id = target.attr('data-prodid');
      var qty = target.attr('data-quantity');
      var unit = target.attr('data-unit');   	
          swal({
              title:"Enter Number of Items:",
              content: "input",
              buttons: ["Cancel","Ok"],
              })
          .then((value) => {
              if (value == "") {
                  swal("Error","Entered none!","error");
              }else if (value == "0") {
                swal("Error","Entered none!","error");
              }else{
                  var qtynum = value;
                  if (isNaN(qtynum)){
                      swal("Error","Please enter a valid number!","error");
              }else if(qtynum == null){
              swal("Error","Please enter a number!","error");
              }else if(parseInt(qtynum,10) > parseInt(qty,10)){
              swal("Error","The stock is lower than the entered number of items!","error");
              }else{

                var pid = target.closest('tr').find(".prod_id").text();
                var pdesc = target.closest('tr').find(".prod_desc").text();
                var pbrand = target.closest('tr').find(".prod_brand").text();
                var punit = target.closest('tr').find(".prod_unit").text();
                var pprice = target.closest('tr').find(".prod_price").text().replace(/,/g, "").replace("₱","");
                var pqty = target.closest('tr').find(".prod_qty").text();

                
                var q13 = target.closest('tr').find('.prod_qty').text();
                console.log("xxxxxxxxx:", q13)

                var w13 = parseInt(q13,10) - parseInt(qtynum,10); 
                console.log("xxxxxxxxx:", w13)
                

                target.find(".prod_qty").text(w13);

                  if (w13 > 20) {        
                    target.find('td:eq(5)').css('background-color', '#198754');
                  }else if (w13 > 0) {        
                    target.find('td:eq(5)').css('background-color', '#ffc107');
                  }else{
                    target.find('td:eq(5)').css('background-color', '#dc3545');
                    target.hide();
                  }

                console.log("x:", pid)
                console.log("x:", pdesc)
                console.log("x:", pbrand)
                console.log("x:", punit)
                console.log("x:", pprice)
                console.log("x:", pqty)
               
                //$.ajax({
                    //url:"cart.php",
                    //method:"POST",
                    //data:{pid:pid, pdesc:pdesc, pbrand:pbrand, punit:punit, pprice:pprice, pqty:pqty, qtynum:qtynum},
                    //success: function(data){
                        //swal("Added to the cart successfully!", {
                        //icon: "success",
                    //});
                    //}
                //});
                
                $(".dataTables_empty").empty();
                var total = parseInt(value,10) * parseFloat(price);
                $('#tabledata').append("<tr class='prd'><td class='barcode'>"+product_id+"</td><td class='product_name'>"+product+"</td><td class='product_brand'>"+brand+"</td><td class='product_unit'>"+unit+"</td><td class='price' align='right'>"+accounting.formatMoney(price,{symbol:"₱",format: "%s %v"})+"</td><td align='right' class='qty'><input name='qty' class='text-center' type='number' pattern='[0-9]*' min='1' value="+value+" readonly></td><td class='totalPrice' align='right'>"+accounting.formatMoney(total,{symbol:"₱",format: "%s %v"})+"<td class='text-center'><button class='btn btn-primary' type='button' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Change quantity' id='quantity-row'><i class='fa-solid fa-arrow-rotate-right'></i></button>  <button class='btn btn-danger' type='button' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Remove this item' id='delete-row'><i class='fa-solid fa-xmark fa-lg'></i></button></td><td class='l13' style='display:none;'>"+w13+"</td> </tr>");
                // $('#tableData').append("<tr class='prd'><td class='barcode text-center'>"+barcode+"</td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"₱",format: "%s %v"})+"</td><td class='text-center'>"+unit+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"₱",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button></tr>");
                
                GrandTotal();

                swal("Added to the cart successfully!", {
                    icon: "success",
                });
                      
          }
              }
      });
  });
});


$('body').on('click','#quantity-row',function(e){
    e.preventDefault();

    $(".addbtn").trigger("click");

    var target = $(this).closest('tr');
    var quantity = target.closest('tr').find('input[name=qty]').val();
    var price = target.closest('tr').find('.price').text().replace(/,/g, "").replace("₱","");
    var r13 = target.closest('tr').find('.l13').text();
    console.log("xxxxxxxxx:", r13)

      swal({
        title:"Change the Quantity of this Item:",
        content: "input",
        buttons: ["Cancel","Ok"],
      })
      .then((value) => {
          if (value == "") {
              swal("Error","Entered none!","error");
          }else if (value <= 0) {
              swal("Error","Please enter a valid number!","error");
          }else{
            var qtynum = value;
          if (isNaN(qtynum)){
            swal("Error","Please enter a valid number!","error");
          }else if(qtynum == null){
            swal("Error","Please enter a number!","error");
          }else if(parseInt(qtynum,10) > parseInt(r13,10)){
            swal("Error","The stock is lower than the entered number of items!","error");
          }else{
    
        console.log("cancel:", value)
        target.find('input[name=qty]').val(value);
        
        var subtotal = parseInt(value,10) * parseFloat(price); 
    
        target.find(".totalPrice").text(accounting.formatMoney(subtotal,{symbol:"₱",format: "%s %v"}));

        swal("Quantity update successfully!", {
            icon: "success",
        });

        GrandTotal();
    }
        }
    });
});



//$('#tabledata').on('keyup mouseup','.qty', function(){

    //var checktableqty = $('.prod_qty').get();
    //var checktableid = $('.prod_id').get();

   //$('.prod_qty').each(function(){
        //checktableqty.push($(this).text());
    //});

    //$('.prod_id').each(function(){
        //checktableid.push($(this).text());
    //});

    //var target = $(this).closest('tr');
    //var quantity = target.closest('tr').find('input[name=qty]').val();
    //var price = target.closest('tr').find('.price').text().replace(/,/g, "").replace("₱","");

    //var subtotal = parseInt(quantity,10) * parseFloat(price); 
    
    //target.find(".totalPrice").text(accounting.formatMoney(subtotal,{symbol:"₱",format: "%s %v"}));
    
    //GrandTotal();

  //}
//);




$("body").on('click','#delete-row', function(e){
    e.preventDefault();
      
    var target = $(this);

    var pidd = target.closest('tr').find('.barcode').text();
    console.log("x:", pidd)

    var quantityadd = target.closest('tr').find('input[name=qty]').val();
    console.log("x:", quantityadd)

    var checktableqty = $('.prod_qty').get();
    var checktableid = $('.prod_id').get();

    $('.prod_qty').each(function(){
        checktableqty.push($(this).text());
    });

    $('.prod_id').each(function(){
        checktableid.push($(this).text());
    });
    
    console.log("xxxxxx:", checktableqty)
    console.log("x:", checktableid)

    //product13 

   //console.log("x:", product13)

    swal({
       title:"Remove this item?",
       icon: "warning",
       buttons: ["Cancel","Yes"],
     })
     .then((willDelete) => {
       if (willDelete) {
            $(this).parents("tr").remove();
            swal("Removed Successfully!", {
            icon: "success",
         });

            console.log("x:", pidd)
            console.log("x:", quantityadd)
            
            //$.ajax({
                //url:"cart.php",
                //method:"POST",
                //data:{pidd:pidd, quantityadd:quantityadd},
                //dataType: "json",
                //success : function(data)
               //{
                   //result($.map(data,function(item){
                        //return item;
                      //}));
               //}
            //});
         
            GrandTotal();
            
            var checktable = $('#tabledata tr .totalPrice').get();

            console.log("x:", checktable)

            if (checktable == 0){
                setTimeout(location.reload.bind(location), 1000);
                return false; 
            }
            //  $(".dataTables_empty").text("No data available in table asd");
            //swal("Warning","No products added!","warning"); 
       }
 });
});

$(document).on('click','.enter',function(e){
    e.preventDefault();

    var TotalPriceArr = $('#tabledata tr .totalPrice').get();

    if (TotalPriceArr == 0){
        swal("Warning","No Products Added!","warning");
        return false; 
    }else{

    var product = [];
    var product_name = [];
    var product_brand = [];
    var product_unit = [];
    var sub_total = [];
    var quantity = [];
    var price = [];
    var transaction_id = $('#transaction_id').val();
    var name = $('#name').val();
    var discount = $('#discountpercent').val();
    var discounted = $('#discounted').val();

    var TotalQuantity = 0;
    var TotalQuantityy = $('#tabledata tr .qty input').get()
  
    $(TotalQuantityy).each(function(){
      TotalQuantity += parseFloat($(this).val());
    });
    

    $('.barcode').each(function(){
      product.push($(this).text());
    });
    $('.product_name').each(function(){
      product_name.push($(this).text());
    });
    $('.product_brand').each(function(){
      product_brand.push($(this).text());
    });
    $('.product_unit').each(function(){
      product_unit.push($(this).text());
    });
    $('.totalPrice').each(function(){
      sub_total.push($(this).text().replace(/,/g, "").replace("₱",""));
    });
    $('input[name=qty]').each(function(){
      quantity.push($(this).val());
    });
    $('.price').each(function(){
      price.push($(this).text().replace(/,/g, "").replace("₱",""));
    });

    swal({
      title: "Enter Cash",
      content: "input",
      buttons: ["Cancel","Ok"],
    })
    .then((value) => {  
      if(value == "") {
        swal("Error","Entered None!","error");
      }else{

        var qtynum = value;
        if(isNaN(qtynum)){
          swal("Error","Please enter a valid number!","error");
        }else if(qtynum == null){
          swal("Error","Entered None!","error");
        }else{

          var change = 0;

          var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("₱",""));

          if(TotalValue > qtynum){
            swal("Error","Can't process a smaller number","error");
          }else{
            change = parseInt(value,10) - parseFloat(TotalValue);
            $.ajax({
              url:"insert_sales.php",
              method:"POST",
              data:{totalvalue:TotalValue, TotalQuantity:TotalQuantity, product:product, product_name:product_name, product_brand:product_brand, product_unit:product_unit, sub_total:sub_total, transaction_id:transaction_id, change:change, qtynum:qtynum, name:name, price:price, quantity:quantity, discount:discount, discounted:discounted},
              success: function(data){
                  swal({
                    title: "Change is " + accounting.formatMoney(change,{symbol:"₱",format: "%s %v"}),
                    icon: "success",
                    buttons: "Okay",
                    closeOnClickOutside: false,
                  })
                  .then((okay)=>{
                    if(okay){
                      window.location.href='print.php?'+data;
                    }
                  })
              }
            });
          }
        }
      }
    });
  }
});




  $(document).on('click','.cancel', function(e){
    e.preventDefault();

    var TotalPriceArr = $('#tabledata tr .totalPrice').get();
    if (TotalPriceArr == 0){
      swal("Warning","No Products Added!","warning");
      return 0;
    }else{
        var piddd = [];
        var quantitycancel = [];

        $('.barcode').each(function(){
            piddd.push($(this).text());
        });
        $('input[name=qty]').each(function(){
            quantitycancel.push($(this).val());
        });

        console.log("cancel:", piddd)
        console.log("cancel:", quantitycancel)

      swal({
        title: "Cancel transaction?",
        text: "By doing this, all added products will remove!",
        icon: "warning",
        buttons: ["Cancel","Yes"],
      })
      .then((reload) => {
        if (reload) {
          location.reload();
        }
        console.log("x:", piddd)
        console.log("x:", quantitycancel)
        
        //$.ajax({
        //url:"cart.php",
        //method:"POST",
        //data:{piddd:piddd, quantitycancel:quantitycancel},
        //});
      });
    }
});  

function out(){
    var lag = "signout";
    swal({
        title: "Sign Out?",
        icon: "warning",
        buttons: ["Cancel","Yes"],
      })
      .then((value) => {
        if(value){
          if(lag){
              $.ajax({
                type: 'post',
                data: {
                   signout:lag
                },
                url: 'server/connection.php',
                success: function (data){
                window.location.href='login.php';
                }
              });
          }
        }
      })
  };