$(document).ready(function(){


  $('a.list').on('click',function(event){
    event.preventDefault()
    $('article').addClass('grid');
  });
  $('a.thumbnail').on('click',function(event){
    event.preventDefault()
    $('article').removeClass('grid');
  });


});
