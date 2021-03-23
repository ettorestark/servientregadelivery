try {
    window.$ = window.jQuery = require('jquery');
    window.jQuery.noConflict(true)
} catch (e) {}





(function(){
    /* This is my app's JavaScript */
    var ServientregaDelivery = function($){

        
        var $this = this;
        // Variablesen
        $this.version        = '2.0.38';
        $this.candebug       = false;
        $this.urlBase        = "https://servientregadelivery.vexecommerce.com";
        //$this.urlBase        = "https://5b1615699d31.ngrok.io";
        $this.workingDaysUrl = $this.urlBase + "/api/workingdays.json";
        $this.workingTimesUrl= $this.urlBase + "/api/workingtime.json";
        $this.timePreparationUrl = $this.urlBase + "/api/gettimepreparation.json";
        $this.queryProducts  = ["#productSelect-product-template", "#ProductSelect-product-template", "#ProductSelect", "select.product-form__master-select", 'input[name="id"]', 'select[name="id"]'];

        $this.settingid      = undefined;
        $this.workingdays    = undefined;
        $this.cbScheduleday  = null;
        $this.cbscheduletime = null;
        $this.ctrlWhen       = null;
        $this.submit        = null;
        $this.currency      = {};
        $this.workingtext   = '';

        $this.disabled      = null;
        $this.cart          = null;

        this.init   = function ($) {
            var body    = $('body');
            var product = selector($this.queryProducts);
            
            if ( (body.hasClass('template-product') || body.hasClass('product') ) && product.length){
                $form = $( "form[id^='product_form_']" );
                $id = $form.attr('id');
                var id_product = $id.substring(13, $id.length);
                this.initProduct(product, id_product);
            }else if( body.hasClass('template-cart') || body.hasClass('cart'))
            {     
                $("head link[rel='stylesheet']").first().before("<link rel='stylesheet' href='"+$this.urlBase+"/css/snippet.css' type='text/css' media='screen'>");
                $("head link[rel='stylesheet']").first().before("<link rel='stylesheet' href='"+$this.urlBase+"/css/bootstrap.min.css' type='text/css' >");       
                this.initCart();
            }
        }


        this.initCart = function () {
            $this = this;
            $.getJSON('/cart.js', function(cart) {
                $this.cart = cart;
                $this.requestSnippet();
            });
        }

        this.requestSnippet = function () {
            var product_list  = new Array();
            var variants_list = new Array();

            $.each($this.cart.items, function (i,product) {
                product_list.push(product.product_id)
            });
            $.each($this.cart.items, function (i,product) {
                variants_list.push({product_id:product.product_id, variant_id:product.variant_id })
            });
            $.ajax({
                type: 'post',
                url: $this.urlBase + "/api/configureTheme.json",
                data: {'shop': window["Shopify"].shop, 'productlist':JSON.stringify(product_list), 'variantlist':JSON.stringify(variants_list), 'cart':JSON.stringify($this.cart) },
                dataType : 'json',
                beforeSend: function( xhr ) {
                }
            }).done(function( response ) {
                if(typeof response === 'undefined'){
                    console.log("Widget servientrega disable");
                }
                else if (response.status.code == 200)
                {
                    $('Form.cart').append(response.snippet);
                    $this.getWorkingDays();
                }
            });
        }


        this.getWorkingDays  = function(){
            $.ajax({
                type: 'post',
                url: $this.workingDaysUrl,
                data: {'shop': window["Shopify"].shop},
                dataType : 'json',
                crossDomain: true,
                beforeSend: function( xhr ) {
                    $("#cbScheduleday").empty();
                }
            }).done(function( response ) {
                $this.setWorkinDays(response);
            });
        }

        this.setWorkinDays = function( workingdays ){
            $("#cbScheduleday").find('option').remove();
            $("#cbScheduleday").prop('required','required');

            $.each(workingdays,function (i, v) {
                var option = $('<option  value="' + v.id + '">' + v.text + '</option>');

                if (v.enable==false) {
                    option.prop('disabled','disabled');
                    option.css('background-color','rgb(128,128,128, 0.2)')
                }
                if (v.immediately!=undefined)   option.prop('immediately',v.immediately);

                $("#cbScheduleday").append(option);
            });

            $("#cbScheduleday").unbind().bind('change',function () {
                $this.getWorkingTimes($(this).val());
            });


            if( $("#cbScheduleday").find('option:eq(0)').prop('disabled')  == 'disabled' ||
                $("#cbScheduleday").find('option:eq(0)').prop('immediately') == false
            ){
                $this.ctrlWhenDisable();
            }


            $.each($("#cbScheduleday").find('option') , function (i,option) {
                if ( $(this).prop('disabled') === false){
                    $("#cbScheduleday").val(  $("#cbScheduleday").find('option').eq(i).val()).trigger('change');
                    return false;
                }
            });


        }
        /**
         *
         * @param day
         */
        this.getWorkingTimes = function (day) {

            if ( $('option:selected', $this.cbScheduleday).attr('disabled') ) {
                return false;
            }


            var product_list = new Array();
            $.each($this.cart.items, function (i,product) {
                product_list.push({product_id:product.product_id, variant_id:product.variant_id })
            });


            $.ajax({
                type: 'post',
                url: $this.workingTimesUrl +"?_d"+(new Date().getTime()),
                data: {'shop': window["Shopify"].shop, 'day':day, 'products':JSON.stringify(product_list)},
                dataType : 'json',
                crossDomain: true,
                beforeSend: function( xhr ) {
                    $("#cbscheduletime").empty();
                }
            }).done(function( response ) {
                $( ".vexsoluciones_customCard_Snippet" ).removeClass( "d-none" )
                $( ".loading" ).addClass( "d-none" )
                $.each(response.hours, function (i,hour) {
                    $("#cbscheduletime").append('<option value="' + hour.id + '">' + hour.text + '</option>');
                });

            });
        }

        this.ctrlWhenDisable  = function (){
            return $("#switch").prop('checked',false).trigger('change').prop('disabled','disabled');
        }
        
        this.initProduct = function (product, id_product) {
            if ( product ) {
                $this.requestProductAvailability(product, id_product);
            }
        }

        this.requestProductAvailability = function (product, id_product) {
            $.ajax({
                type: 'post',
                url: $this.urlBase + "/api/productavailability.json",
                data: {'shop': window["Shopify"].shop, 'product':id_product},
                dataType : 'json',
                beforeSend: function( xhr ) { }
            }).done(function( response ) {
                if(typeof response === 'undefined'){
                    console.log("Widget servientrega disable");
                }
                else if(response.status.code == 200)
                {
                    product.closest('form').prepend(response.snippet);
                }
            });
        }

        var selector = function (selectors){

            for (let t=0; t < selectors.length; t++){
                let el = $(selectors[t]);
                if (el.length) {
                    $el= $(el[0]);
                    $el.selector = selectors[t];
                    return $el;
                }
            }

            return false;
        }


        init($);

    };

    window.$ =  require('jquery');
    ServientregaDelivery(require('jquery'));
  

})();
