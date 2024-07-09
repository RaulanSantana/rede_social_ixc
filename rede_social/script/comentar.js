$(document).ready(function() {
    $('.comment-toggle').click(function(e) {
        e.preventDefault();
        var commentSection = $(this).siblings('.comment-section');
        commentSection.toggle();
       
        commentSection.find('textarea').toggle(); 
    });
});
