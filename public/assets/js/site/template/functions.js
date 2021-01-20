
$(document).ready(function(){ 

  var default_value = $("#search .nice_search").val(); 

  $("#search .nice_search").focus(function() { 
    if($("#search .nice_search").val() == default_value) $("#search .nice_search").attr("value",""); 
  }); 
  $("#search .nice_search").blur(function() { 
    if($("#search .nice_search").val() == "") $("#search .nice_search").attr("value",default_value); 
  }); 
  
  var default_value2 = $("#newsletter-value").val(); 
  
  $("#newsletter-value").focus(function() { 
    if($("#newsletter-value").val() == default_value2) $("#newsletter-value").attr("value",""); 
  }); 
  $("#newsletter-value").blur(function() { 
    if($("#newsletter-value").val() == "") $("#newsletter-value").attr("value",default_value2); 
  }); 
  
  $('#wrap-categories .expanded').click(function() {
    if($("ul#category-menu").css("display") == 'none'){
      $('#wrap-categories .expanded').css("background", "url(images/cat-expanded-icon.png) no-repeat center center");
      $("ul#category-menu").show();
    }
    else{
      $('#wrap-categories .expanded').css("background", "url(images/cat-collapsed-icon.png) no-repeat center center"); 
      $("ul#category-menu").hide();
    }
  });
  
  $("ul#category-menu li").click(
    function () {
      if( $(this).find("ul.subcategory").length > 0){
        var status = $(this).find("ul.subcategory").css("display");
        if(status == "none"){
          $(this).find('a.extends').css("background", "#EEB900 url(images/submenu-arrow.png) no-repeat 210px center"); 
          $(this).find('a.extends').css("color", "#363031"); 
          $(this).find("ul.subcategory").css("display","block");
        }
        else{
          $(this).find('a.extends').css("background", "#2A2A2A url(images/cat-menu-arrow.png) no-repeat 210px center"); 
          $(this).find('a.extends').css("color", "#ffffff"); 
          $(this).find("ul.subcategory").css("display","none");
        }
      }
    }
  );

  $('.wrap-tabs .tabs a').click(function(){
       $('.wrap-tabs .tabs a').removeClass('active');
       $(this).addClass('active');
       $('.wrap-tabs-content div').css('display','none');
       $('.wrap-tabs-content #'+$(this).attr('id')+'-content').css('display','block');
      return false;
  });
  
  	/*PREVIEW FUNCTION ONLY FOR LINKS */
 //  	$('#block-product-list a, #inline-product-list a').click(function(){
	//  	document.location = '4_interior_product_view.html'; 
	// 	return false;
	// });
 //  	$('.add-quantity input, .addcart').click(function(){
	//  	document.location = '5_interior_shopping_cart.html'; 
	// 	return false;
	// });
 //  	$('.checkout, .continue, .cart-summarry a').click(function(){
	//  	document.location = '7_interior_checkout_step1.html'; 
	// 	return false;
	// });
});