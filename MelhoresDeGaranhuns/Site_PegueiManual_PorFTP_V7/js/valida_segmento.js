var form_segmento = document.querySelector("#form-segmento");
var segmento = form_segmento.querySelector("input[name='novo-segmento']");
var alertas_seg = document.querySelector("#alertaSegmento");

form_segmento.querySelector("button").addEventListener("click", function(){
    if(segmento.value == undefined || segmento.value == ""){
        alertas_seg.innerHTML = "<div class=\"alert alert-danger color-danger\">Insira um segmento.</div>";
    }else if(segmento.value.length < 3){
        alertas_seg.innerHTML = "<div class=\"alert alert-danger color-danger\">Tamanho minimo: 3.</div>";
    }else{
        alertas_seg.innerHTML = "";
        form_segmento.submit();
    }
});