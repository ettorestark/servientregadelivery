$(document).ready(function(){

    validateApikeys();
    

    $('#add_holliday').click(function(){
        var $div = $('div[id^="holidays-form0"]:last');
        var $divAfter = $('div[id^="holidays-form"]:last');
        var num = parseInt( $divAfter.prop("id").match(/\d+/g), 10 ) +1;
        var $clone = $div.clone();
        
        var selectDays =$clone.children().eq(0).children().eq(0);
        var selectMonths =$clone.children().eq(1).children().eq(0);
        var deleteButton = $clone.children().eq(2).children().eq(0);

        selectDays.prop('id', "days"+num);
        selectMonths.prop('id', "months"+num);
        selectDays.prop('name', "holidays[day]["+ (num) +"]");
        selectMonths.prop('name', "holidays[month]["+(num)+"]");
        deleteButton.prop('id', num);
        $clone.prop('id', 'holidays-form'+num );
        $clone.css('display', 'block');
        $divAfter.after( $clone );
    });

    $(document).on('click', '.remove_holiday', function(){
        var button_id = $(this).attr("id");
        $("#holidays-form"+button_id).remove();
    });

    $('.form-check input').on('change', function () {
        value = $('input[name=SETT_COST_TYPE]:checked').val();
        if(value == "Fixed"){
            $("#custom-cost").css("display", "block");
        }
        else{
            $("#custom-cost").css("display", "none");
        }
        if(value == "Percentage"){
            $("#custom-percentage").css("display", "block");
            $("#messagePercentage").css("display", "block");
        }
        else{
            $("#custom-percentage").css("display", "none");
            $("#messagePercentage").css("display", "none");
        }
        if(value == "Freefor"){
            $("#custom-Freefor").css("display", "block");
        }
        else{
            $("#custom-Freefor").css("display", "none");
        }
    });

    $('.api_information input').on('change', function () {
        validateApikeys();
    });

    //Selecciona el valor del mes 
    $(document).on('change', '.holiday-month', function(){
        $id = parseInt( $(this).attr("id").match(/\d+/g), 10 );
        $selectedMonth = $(this).val();
        $days = daysInMonth($selectedMonth, 1965)
        anableOptions($days, $id)
    });

    

    $('#enableDobleTurn').on('change', function () {
        $display = $(".dobleTurn").css("display");
        if($display == "none"){
           $(".dobleTurn").css("display" , "flex"); 
        }
        else{
            $(".dobleTurn").css("display" , "none"); 
        }
    });


    function daysInMonth (month, year) { 
        return new Date(year, month, 0).getDate(); 
    } 
    //Activa y desactiva las fechas
    function anableOptions($days, $id){
        for($i = 1 ; $i <= 31; $i++){
            if($i <= $days) {
                $("#days"+$id+" option[value="+$i+"]").css('display', 'block');
            }
            else{
                $("#days"+$id+" option[value="+$i+"]").css('display', 'none');
            }
        }
    }

    function validateApikeys(){
        $apiKey = $('input[name=SETT_SERVIENTREGA_API]').val();
        $apiSecret = $('input[name=SETT_SERVIENTREGA_SECRET]').val();
        
        if ( $apiKey.length > 1 && $apiSecret.length > 5  ){
            $("#btn-test-conexion").removeAttr('disabled');
        }
        else{
            $('#btn-test-conexion').attr('disabled','disabled');
        }
    }
    
});

