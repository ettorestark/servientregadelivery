@extends('shopify-app::layouts.default')

@section('content')
<h2>servientrega Delivery for Shopify </h2>
<section class="spy-width-medium-9-10">
    <div class="card vex_soluciones_instructions">
        <div class="col-12 col-md-12">

            <h2 class="text-center" >&nbsp;&nbsp; @lang('servientrega.welcome.gettinstarted')</h2>

            <div class="text-center" style="margin: auto">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="90%" height="450" type="text/html" src="@lang('servientrega.welcome.video')"><</iframe>
            </div>

            <br>
            <p> <h2>@lang('servientrega.welcome.p1')</h2></p>

            <ol class="colored">

                <li class="mt-5">
                    <h3> @lang('servientrega.welcome.l2.t1')</h3>
                    <p> @lang('servientrega.welcome.l2.t2.title')</p>
                    <div style="align-items: center; text-align: left">
                        <img src="{{ asset('/assets/images/settings-1.jpg') }}" width="95%" style="margin: auto">
                        <ul class="mt-5">
                            <li>@lang('servientrega.welcome.l2.t2.helps.c1')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c2')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c3')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c4')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c5')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c6')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c8')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c9')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c10')</li>
                            <li>@lang('servientrega.welcome.l2.t2.helps.c11')</li>
                        </ul>
                    </div>

                    <br>
                    <br>

                    <p>@lang('servientrega.welcome.l2.t3.title')</p>

                    <div style="align-items: center;">
                        <img src="{{ asset('/assets/images/settings-2.jpg') }}" width="95%" style="margin: auto">
                    </div>

                    <ul>
                        <li>
                            <p>@lang('servientrega.welcome.l2.t3.helps.c1')</p> 
                            <div style="padding: 12px">
                                <a target="_blank" href="{{ asset('/assets/images/servientrega_countrys.png') }}"><img src="{{ asset('assets/images/servientrega_countrys.png') }}" width="40%" style="margin: auto"></a>
                            </div>
                            <p>@lang('servientrega.welcome.l2.t3.helps.c2')</p> 
                            <div style="padding: 12px">
                                <a target="_blank" href="{{ asset('/assets/images/setting-address-1.png') }}"><img src="{{ asset('assets/images/setting-address-1.png') }}" width="40%" style="margin: auto"></a>
                                <a target="_blank" href="{{ asset('/assets/images/setting-address-2.png') }}"><img src="{{ asset('assets/images/setting-address-2.png') }}" width="40%" style="margin: auto"></a>
                            </div>
                        </li>
                        <li> <p> @lang('servientrega.welcome.l2.t3.helps.c3') </p></li>
                        <li> <p> @lang('servientrega.welcome.l2.t3.helps.c4') </p></li>
                    </ul>
                    <br>
                    <br>

                </li>
                

                <li class="mt-5">
                    <h3> @lang('servientrega.welcome.l3.t1')  </h3>
                    <p> @lang('servientrega.welcome.l3.t2') </p>
                    <div class="text-center" >
                        <img src="{{ asset('/assets/images/products-1.jpg') }}" width="95%" style="margin: auto">
                    </div>
                    <br>
                    <p>@lang('servientrega.welcome.l3.t3')</p> 
                    <div class="text-center">
                        <img src="{{ asset('/assets/images/products-2.jpg') }}" width="95%" style="margin: auto">
                    </div>

                </li>

                <!-- <li>
                    <h3> @lang('servientrega.welcome.l4.t1') </h3>
                    <p> @lang('servientrega.welcome.l4.t2') </p>
                    <div style="align-items: center; text-align: center">
                        <img src="{{ asset('assets/images/frontstore-product-1.png') }}" width="95%" style="margin: auto">
                    </div>
                    <br>
                </li> -->
                <li class="mt-5">
                    <h3> @lang('servientrega.welcome.l6.t1')  </h3>
                    <p> @lang('servientrega.welcome.l6.t2') </p>
                
                    <div style="align-items: center; text-align: center">
                        <img src="{{ asset('assets/images/widget.png') }}" width="95%" style="margin: auto">
                    </div>

                    <div style="align-items: center; text-align: center">
                        <img src="{{ asset('assets/images/frontstore-product-1.png') }}" width="95%" style="margin: auto">
                    </div>

                    <div style="align-items: center; text-align: center">
                        <img src="{{ asset('assets/images/frontstore-cart-1.png') }}" width="95%" style="margin: auto">
                    </div>

                    
                    
                    <br>
                </li>
            </ol>

        </div>
    </div>
</section>
<section>
    <div style="text-align: center" class="spy-width-medium-9-10">
        <ul style="width: 250px; margin: auto">

            <li>
                <span class="note">Contact us </span>
                <span class="email"><a target="_blank" href="mailto:soporte@vexsoluciones.com">soporte@vexsoluciones.com</a></span>
            </li><br>
        </ul>
    </div>
</section>
@endsection

@section('scripts')
    @parent
    

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection