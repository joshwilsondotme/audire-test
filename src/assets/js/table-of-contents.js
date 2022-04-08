$('.staff__section, .products__section, .resources__section, .toc-item').each(function() {
var id = $(this).prop('id');
var stringConv = id.match(/[^ -]+/g).join(' ');


  if (id.length > 0) {
    $('#toc').append('<li class="table-contents__item"><a class="table-contents__link" href=\"#' + id + '\">' + stringConv + '</a></li>');  
  }
});


$('.single-post__content h2').each(function() {
  var id = $(this).prop('id');

  if (id.length > 0) {
     $('#toc').append('<li class="table-content__item"><a class="table-content__link" href=\"#' + id + '\">' + $(this).html() + '</a></li>');
   }
 });