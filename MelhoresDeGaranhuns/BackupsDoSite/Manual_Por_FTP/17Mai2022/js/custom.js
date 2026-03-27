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


var linksPagenation = document.querySelectorAll(".btn-page");
var boxEmpresas = document.querySelectorAll(".box-empresa");

if(linksPagenation != null)
{
    linksPagenation.forEach(lp => {
        lp.addEventListener("click", function(e){
            var pag = parseInt(lp.innerHTML);
            
            boxEmpresas.forEach(be => {
                if(be.dataset.page == pag)
                {
                    be.classList.remove("hidden-item");
                }else
                {
                    be.classList.add("hidden-item");
                }
            })
            
        })
    })   
}