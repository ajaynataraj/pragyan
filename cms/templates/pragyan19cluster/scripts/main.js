$(document).ready(function(){
  display_cluster();
});

function display_cluster()
{
    var path = location.pathname;
    var pathArray = location.pathname.split('/');
    pathArray = pathArray.filter(Boolean);
    if(pathArray[pathArray.length-1] == 'events')
	  {
      $.each($('.tab-pane'),function(index,value){$(value).removeClass('active')});
      $("#section_main").addClass(' active');
	    return;
    }
    
      $.each($('.tab-pane'),function(index,value){$(value).removeClass('active')});
      $("#section_"+pathArray[pathArray.length-1]).addClass(' active');
}