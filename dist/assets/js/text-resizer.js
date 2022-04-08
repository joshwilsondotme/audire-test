// $(document).ready(function() {
//    $('.resizer a').click(function() {
//     var textSize = $(this).parent().attr('class');
//     $('.site-content').removeClass('text-sm text-lg').addClass(textSize);
//     return false;
//   });
// });

$(document).ready(function() { 
  var size = $('.site-content p').css('font-size'); 
  $("#smallFont").click(function(){ 
    $('.site-content p:not(.btn)').css('font-size', 'var(--text-sm)');
    return false; 
  });
  
  $("#resetFont").click(function(){ 
    $('.site-content p').removeAttr('style')
    return false; 
  }); 
  
  $("#largeFont").click(function(){ 
    $('.site-content p:not(.btn)').css('font-size', 'var(--text-md)');
    return false; 
  });
});