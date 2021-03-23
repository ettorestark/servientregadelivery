@extends('shopify-app::layouts.default')

@section('content')
    <header id="vexsoluciones_header" class="mb-4">
        <article>
            <h2>@lang('servientrega.orders.header.title')</h2>
            <h3>@lang('servientrega.orders.header.subtitle')</h3>
        </article>
    </header>

    @if ($message = Session::get('success') )
        <section>
            <article>
                <div style="width: 100% !important;" class="alert success">
                    <dl>
                        <dt> Success!</dt>
                        <dd>{{ $message }}</dd>
                    </dl>
                </div>
            </article>
            @push('customscripts')
            <script>
                ShopifyApp.flashNotice("{{ $message }}");
            </script>
            @endpush
        </section>
    @endif

    @if ($message = Session::get('myerror') )
        <section>
            <article>
                <div style="width: 100% !important;" class="alert warning">
                    <dl>
                        <dt> Warning!</dt>
                        <dd>{{ $message}}</dd>
                    </dl>
                </div>
            </article>
            @push('customscripts')
                <script>
                    ShopifyApp.flashError("{!! str_replace(array("\n","\t"), " ", $message) !!}");
                </script>
            @endpush
        </section>
    @endif


    <section id="vexsoluciones_section" class="spy-width-medium-9-10">
            <div class="card">
                <table id="vexsoluciones_table" class="table">
                    <thead id="vexsoluciones_thead" class="mb-4">
                        <tr>
                            <th>@lang('servientrega.orders.table.headers.order')</th>
                            <th>Guía</th>
                            <th>Fecha de creación</th>
                            <th>@lang('servientrega.orders.table.headers.customer')</th>
                            <th>@lang('servientrega.orders.table.headers.deliveryaddress')</th>
                            <th>@lang('servientrega.orders.table.headers.paid')</th>
                            <th>@lang('servientrega.orders.table.headers.servientregastatus')</th>
                            <th>@lang('servientrega.orders.table.headers.actions')</th>
                        </tr>
                    </thead>
                    <tbody id="vexsoluciones_tbody">
                        @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('orderDetail', ['id_order' => $order['id'] , 'id_shipping' => $order['shipping_id'] ]) }}">{{$order["name"]}}</a> </td>
                                <td>
                                @if($order->job_status == "Error" || $order->job_status ==null)
                                    Sin PDF generado
                                @else
                                    <a target="_blank" href="{{ route('see_pdf_stickers', ['guide_number' =>$order['shipping_id'] ]) }}">PDF</a>
                                @endif
                                </td>
                                <td>{{$order['created_at']}}</td>
                                <td>{{$order['customer']}}</td>
                                <td>{{$order['shipping_address']}}</td>
                                <td>Paid</td>
                                <td>
                                    @if(isset($order->job_status ))
                                        @if( strtolower( $order->job_status  ) == "finished")
                                            <label class="success"> {{ $order->job_status  }} </label>
                                        @elseif( strtolower($order->job_status  ) == "canceled" )
                                            <label class="error"> {{ $order->job_status  }} </label>
                                        @elseif(  $order->job_status == "Error" || $order->job_status == "Manual")
                                            <label class="error"> @lang('servientrega.orderdetail.nocreate.label') </label>
                                        @endif
                                    @else
                                        <label >Error al generar guía</label>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($order->job_status ))
                                        @if( strtolower($order->job_status  ) == "canceled" )
                                            <form action="" method="post" id="resendForm_{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="guide_number" value="{{$order['shipping_id']}}">
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <label class="success pointer" onclick="submit(resendForm_{{$order->id}})">{{ strtoupper(__('servientrega.buttons.resend')) }}</label>
                                            </form>
                                        @elseif( strtolower($order->job_status  ) == "error" )
                                            <form action="{{route('orders.resendServientrega')}}" method="post" id="resendForm_{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <label class="success pointer" onclick="submit(resendForm_{{$order->id}})">{{ strtoupper(__('servientrega.buttons.send')) }}</label>
                                            </form>
                                        @elseif( strtolower($order->job_status) == "finished" )
                                            <label><a style="text-decoration:none; color:black" href="{{ route('orderDetail', ['id_order' => $order['id'] , 'id_shipping' => $order['shipping_id'] ]) }}">{{ strtoupper(__('servientrega.buttons.see')) }}</a></label>
                                            <form action="{{route('orders.cancel')}}" method="post" id="cancelForm_{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="guide_number" value="{{$order['shipping_id']}}">
                                                <input type="hidden" name="order_id" value="{{$order['id']}}">
                                                <label class="pointer error" onclick="submit(cancelForm_{{$order->id}})"><span> {{ strtoupper(__('servientrega.buttons.cancel')) }} </span></label>
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{route('orders.resendServientrega')}}" method="post" id="resendForm_{{$order->id}}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <label class="success pointer" onclick="submit(resendForm_{{$order->id}})">{{ strtoupper(__('servientrega.buttons.resend')) }}</label>
                                        </form>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if($orders->total() > 0)
                <nav aria-label="Page navigation example">
                    <ul class="pagination ml-auto">
                        <li class="page-item" ><a class="page-link" href="{{$orders->previousPageUrl()}}">@lang('servientrega.buttons.previous')</a></li>
                        @for($i = 1; $i <= $orders->lastPage(); $i++)  
                            <li class="page-item {{ ($i == $orders->currentPage()) ? 'active' : '' }}"><a class="page-link" href="{{$orders->url($i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="{{$orders->nextPageUrl()}}">@lang('servientrega.buttons.next')</a></li> 
                    </ul>
                </nav>
                @endif



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
            title: 'Orders',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

        function submit(form){
            $(form).submit();
        }

    </script>
@endsection