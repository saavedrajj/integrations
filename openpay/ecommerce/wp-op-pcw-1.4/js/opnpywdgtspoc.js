jQuery(document).ready(function($){
  jQuery('li.tab-link').click(function(){
    var tab_id = jQuery(this).attr('data-tab');
    // tabs
    jQuery(this).parent('ul.widget-tabs').find('li.tab-link.current').removeClass('current');
    jQuery(this).addClass('current');

    //content
    jQuery(this).parent('ul.widget-tabs').parent('.details-price').find('.tab-content.current').removeClass('current');   
    jQuery(this).parent('ul.widget-tabs').parent('.details-price').find("#"+tab_id).addClass('current');
  });
});