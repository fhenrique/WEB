$(".scroll-link").click(function(e){
    e.preventDefault();
    var id = $(this).attr('href'),
        targetOffset = $(id).offset().top;

    $('html, body').animate({
        scrollTop: targetOffset
    }, 500);
});

var sel_seg = document.querySelector("select[name='s']");

sel_seg.addEventListener("change", function(){
    window.location.href = "?s="+sel_seg.value;
    window.reload();
});