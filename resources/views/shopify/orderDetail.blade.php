@extends('shopify-app::layouts.default')

@section('content')

{{-- Contenedor --}}
{{-- <p>@lang('servientrega.orders.table.headers.paid')</p> --}}


{{-- Start titulo --}}
<div class="row mt-5 ml-5">
    @php
        use Carbon\Carbon;
        Carbon::setLocale($language);
    @endphp
    <p id="vexsoluciones_title" class="text-dark"><b>{{$order->name}}</b>  {{ Carbon::createFromFormat('Y-m-d H:i:s', $orderdb->created_at , $storeTimeZone )->isoFormat('LLL') }} {{$order->financial_status}}</p>
</div>
{{-- End titulo --}}
{{-- start first row --}}
<div id="vexsoluciones_content" class="row mt-5">
    <div id="vexsoluciones_first_section" class="col-12 col-md-5 pl-0">
        <div class="row">

            <div id="vexsoluciones_first_card_first_section" class="col-12">
                <div class="card vexsoluciones_customCard">
                    <table class="table table-striped m-0">
                        <thead class="customTD text-center">
                            <tr>
                                <th class=" p-4"><b>
                                @if($order->financial_status=='paid')
                                    <img src="{{ asset('assets/images/icons/pay_success.svg') }}" width="32">
                                @elseif($order->financial_status=='authorized')
                                    <img src="{{asset('assets/images/icons/autorized.png')  }}" width="32">
                                @endif
                                    {{$order->financial_status}}</b></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="customTD">
                            <tr>
                                <td>Subtotal</td>
                                <td>{{ Count($order->line_items) }} Items</td>
                                <td>$ {{ $order->subtotal_price }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>{{ $order->shipping_lines[0]->title }}</td>
                                <td>$ {{ $order->shipping_lines[0]->price_set->shop_money->amount }}</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>
                                    @if( count($order->tax_lines) != 0 )
                                        {{ ($order->tax_lines[0]->rate)*100 }}%
                                    @else
                                        0 %
                                    @endif
                                </td>
                                <td>
                                    @if( count($order->tax_lines) != 0)
                                        $ {{ $order->tax_lines[0]->price }}
                                    @else
                                        $ 0.00
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Total</b></td>
                                <td></td>
                                <td><b>$ {{$order->total_price}}</b></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class=" text-secondary">Paid by customer</th>
                                <th></th>
                                <th>$ {{$order->total_price}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div id="vexsoluciones_second_card_first_section" class="col-12 mt-5">
                <div class="card vexsoluciones_customCard pl-5 pr-5 pt-5 pb-2">
                    <table class="table table-striped">
                        <tbody class="customTD">
                            @foreach($order->line_items as $orderProduct)
                            <tr>
                                @foreach ($products as $product)
                                    @if($product->id == $orderProduct->product_id )
                                        <td><img src="{{$product->image->src}}" class="img-fluid" width="50px"></td>
                                    @endif                                
                                @endforeach    
                                <td class="align-middle">{{$orderProduct->name}}</td>
                                <td class="align-middle">{{$orderProduct->price}} X {{$orderProduct->quantity}}</td>
                                <td class="align-middle">{{ $orderProduct->price * $orderProduct->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div id="vexsoluciones_second_section" class="col-12 col-md-3  pl-0">
        <div class="row">

            <div id="vexsoluciones_first_card_second_section" class="col-12">
                <div class="card vexsoluciones_customCard">
                    <div class="card-body p-5">
                        <p class="card-title text-dark"><b>@lang('servientrega.orderdetail.pickupaddress.title')</b></p>
                        <hr>
                        <p class="mt-3 mb-2 text-left">{{ $location->name }}</p>
                        <p class="text-left mb-2">
                        {{ $location->address1 }}  
                        @if(!empty($location->address2))
                            {{ $location->address2 }}
                        @endif
                        {{ $location->zip }}
                        </p>
                        <p class="text-left mb-2">{{ $location->city }}, {{ $location->province }}, {{ $location->country }}</p>
                        <p class="text-left mb-2">
                            @if(!empty($location->phone))
                                {{ $location->phone }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div id="vexsoluciones_second_card_second_section" class="col-12 mt-5">
                <div class="card vexsoluciones_customCard">
                    <div class="card-body p-5">
                        {{-- start contact address --}}
                        <div>
                            <p class="card-title text-dark"><b>@lang('servientrega.orderdetail.contact.title')</b></p>
                            <hr>
                            <p class="mt-3 mb-2 text-left">{{$order->customer->first_name}} {{$order->customer->last_name}}</p>
                            <p class="text-left mb-2 text-primary">
                            @if($order->customer->email != null)
                                {{$order->customer->email}}   
                            @else
                                No e-mail
                            @endif
                            </p>
                            <p class="text-left mb-2">
                            @if($order->customer->phone != null)
                                {{$order->customer->phone}}   
                            @else
                                No phone
                            @endif
                            </p>
                        </div>
                        {{-- end contact address --}}
                        {{-- start delivery address --}}
                        <div class="mt-5">
                            <p class="card-title text-dark"><b>@lang('servientrega.orderdetail.destination.title')</b></p>
                            <hr>
                            <p class="mt-3 mb-2 text-left">{{$order->shipping_address->first_name}} {{$order->shipping_address->last_name}}</p>
                            <p class="mt-3 mb-2 text-left">{{$order->shipping_address->address1 }}</p>
                            <p class="mt-3 mb-2 text-left">{{$order->shipping_address->city }}</p>
                            <p class="mt-3 mb-2 text-left">{{$order->shipping_address->zip }}</p>
                            <p class="text-left mb-2">{{$order->shipping_address->city }}, {{$order->shipping_address->province }}, {{$order->shipping_address->country}}</p>
                            <br>
                            <a class="card-link" href="https://maps.google.com/?q={{ $order->shipping_address->latitude }},{{ $order->shipping_address->longitude }}&t=h&z=17" target="_blank"> @lang('servientrega.orderdetail.viewmap.title')</a>
                        </div>
                        {{-- end delivery address --}}

                    </div>
                </div>
            </div>

        </div>
    </div>

    @if($servientregaDelivery)
        @include('partials.orderStatus.success', ["servientregaDelivery"=>$servientregaDelivery])
    @else
        @include('partials.orderStatus.failed', ["orderdb" =>$orderdb] ) 
    @endif
</div>
</div>

@include('partials.modalRecoleccion')





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
            title: 'ordenDetail',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

        function submit(form){
            $(form).submit();
        }
</script>
@endsection
