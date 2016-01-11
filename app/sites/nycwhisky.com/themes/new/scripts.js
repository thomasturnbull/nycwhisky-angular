Drupal.behaviors.newtheme = function(context) {
  $('body.event #edit-title').focus(function(){
    var parentframe = parent.document.getElementById("eventframe");
    $('body.event').removeClass('event');
    parentframe.height = $(document).height(); 
  });
};
