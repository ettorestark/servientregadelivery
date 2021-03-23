const { isEmpty } = require("lodash");

$(document).on('click', '.title-product', function(){
    //Get values
    $id_product = $(this).attr("data-product");
    $time_prepartion = $("#time_preparation_"+$id_product).val();
    $id_meta = $("#id_meta_"+$id_product).val();
    $enable = $("#enable_"+$id_product).val();
    $dimensions = $("#dimensions_"+$id_product).val();

    //Sett values in modal
    $clone =  $("#image-product-"+$id_product).clone();
    $("#modal-image").empty();
    $("#modal-image").append($clone);
    $titlemodal = $("#title-product-"+$id_product).text();
    $("#title-modal").text($titlemodal);
    $("#id_producto").val($id_product);
    $("#id_meta").val($id_meta);

    if(!isEmpty($dimensions)){
        if($dimensions.length > 0){
            $dimensions = $dimensions.split("x");
            $alto  = $dimensions[0];
            $largo = $dimensions[1];
            $ancho = $dimensions[2];
            $("#alto").val($alto);
            $("#largo").val($largo);
            $("#ancho").val($ancho);
        }  
    }
    else{
        $("#alto").val(1);
        $("#largo").val(1);
        $("#ancho").val(1);
    }
    
    

    if($enable){
        $("#available_for_servientrega").prop("checked", true);
    }
    else{
        $("#available_for_servientrega").prop("checked", false);
    }

    if($time_prepartion != null){
        $("#vexsoluciones_select").val($time_prepartion);
    }
    else{
        $("#vexsoluciones_select").val("immediately");
    }

    

    
});
