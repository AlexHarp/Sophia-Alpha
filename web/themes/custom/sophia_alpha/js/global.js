(function ($) {
    $(document).ready(function() {
   
     $('.cce').click(function() {  
          
          $(".view-id-entity_types").show();
     });
     
     $('.view-id-entity_types').mouseleave(function() {  
      
          $(".view-id-entity_types").hide();
      });
/*
      $('.view-id-summary_key').hover(function() {  
      
        $(".view-id-summary_key .table span a").css(color, red);
      });

    $('.ncce').click(function() {  
      var et = $('.view-id-entity_type');
      $("#entitytypeinfo").html(et + "To come from view block. so the ids are displayed automatically as updated in database");
      $(".view-id-entity_types").dialog();
  });
*/
flipKeyColours();
function flipKeyColours () {
//var flipKey = $('.view-id-summary_key .table span a').val();

 // if ( flipKey == 'I') {
  //  $(".view-id-summary_key .table span a").addClass("I_Key");
  //}
  //else {
  //  $(".view-id-summary_key .table span a").addClass("summaryFlipKeys");
  //};
  

};
    

    });
   })(jQuery);