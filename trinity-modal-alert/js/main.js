jQuery(document).ready(function () {    
    var checkboxPages = $('#pages-checkbox');
    var dependentPages = $('#tt-page-list');

    var checkboxPosts = $('#posts-checkbox'); 
    var dependentPosts = $('#tt-post-list');

    if (checkboxPages.attr('checked') !== undefined){
        dependentPages.show();
     } else {
        dependentPages.hide();
     }
     checkboxPages.change(function(e){
        dependentPages.toggle(); 
     });


     if (checkboxPosts.attr('checked') !== undefined){
        dependentPosts.show();
     } else {
        dependentPosts.hide();
     }
     checkboxPosts.change(function(e){
        dependentPosts.toggle(); 
     });

    
    // display modal
    $('#tallModal').modal('show');
   
});