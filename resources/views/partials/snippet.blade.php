<!--70000 is the limit weight for stuart-->
@if ( $servientrega_shipping_available_items == true  and $total_weight  < 68000 )
    <div id="vexsoluciones_snippet">
        <input type="hidden" name="attributes[order_available_for_servientrega]" value="1">

        <div id="vexsoluciones_servientrega_card" class="col-12 col-md-8 mt-3">
            <div class="loading mt-3" ></div>

            <div class="card vexsoluciones_customCard_Snippet d-none pl-0 ml-0">   
                        
                <div id="vexsoluciones_card_title" class="col">
                    <h2 class="vexsoluciones_snippet_title text-left pl-4">{{$settings->getMethodTitle()}}
                    @isset($img)
                        @if($img != "")
                            <img src="{{asset('uploads/').'/'.$img}}" class="img-fluid" width="100px" >
                        @endif
                    @endisset
                    </h2>
                </div>
                @if($settings->SETT_ALLOWSCHEDULED == 1)
                    <p  id="vexsoluciones_cart_available" class="vexsoluciones_cart_available text-left pl-4 mt-2"><b class="text-success">@lang('servientrega.storefront.template.cart.available')</b></p>
                    <p  id="vexsoluciones_cart_text" class="vexsoluciones_cart_text text-left pl-4">@lang('servientrega.storefront.template.cart.when.label')</p>
                    <p  class="text-left pl-4 d-flex align-items-center">
                        <label class="vexsoluciones_cart_switch">
                        <input id="switch" type="checkbox" name="attributes[immediately]" checked value="immediately" onchange="test()">
                        <span class="vexsoluciones_cart_slider round"></span>
                        </label>    
                        <span id="assoon" class="vexsoluciones_cart_span pl-2" >@lang('servientrega.storefront.template.cart.when.assoon')</span>
                        <span id="question" class="vexsoluciones_cart_span pl-2" style="display: none"> @lang('servientrega.storefront.template.cart.when.question')</span>
                    </p>
                    <div class="form-row align-items-center ml-3" id="dateForm" style="display: none">
                        <div class="col-auto">
                            <label for="">@lang('servientrega.storefront.template.cart.day'):</label>
                            <select id="cbScheduleday" class="form-control mb-2" name="attributes[day]" required>
                            <option value=""> loading... </option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="">@lang('servientrega.storefront.template.cart.hour'):</label>
                            <select id="cbscheduletime" class="form-control mb-2" name="attributes[hour]" required>
                            <option value=""> loading... </option>
                            </select>
                        </div>
                    </div>
                @else
                    <div class='vexsoluciones_cart_time text-left pl-4 py-3'>
                        <p class="vexsoluciones_cart_available text-left pl-4 text-success">@lang('servientrega.storefront.template.cart.noallowscheduled')</p>
                    </div>
                        
                    <div class="form-row align-items-center ml-3" id="dateForm" style="display: none!important">
                        <div class="col-auto">
                            <label for="">@lang('servientrega.storefront.template.cart.day'):</label>
                            <select id="cbScheduleday" class="form-control mb-2" name="attributes[day]" required>
                            <option value=""> loading... </option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="">@lang('servientrega.storefront.template.cart.hour'):</label>
                            <select id="cbscheduletime" class="form-control mb-2" name="attributes[hour]" required>
                            <option value=""> loading... </option>
                            </select>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@else
    <input type="hidden" name="attributes[order_available_for_servientrega]" value="0">
@endif
   
<script>
    function test(){
        $value = $("#dateForm").css("display");
        if($value == "none"){
            $("#dateForm").css("display", "flex");
            $("#assoon").css("display", "none");
            $("#question").css("display", "block");
            $(".test").css("display", "none");

        }
        else{
            $("#dateForm").css("display", "none");
            $("#assoon").css("display", "block");
            $("#question").css("display", "none");
            $(".test").css("display", "block");
        }
    }
</script>
    