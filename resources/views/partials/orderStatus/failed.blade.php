<div id="vexsoluciones_third_section" class="col-12 col-md-4  pl-0">
        <div class="row">
            <div  id="vexsoluciones_first_card_third_section" class="col-12">
                <div class="card vexsoluciones_customCard p-5">
                    <table class="table table-striped m-0">
                        <thead>
                            <h5 class="card-title">@lang('servientrega.orderdetail.panel.title')</h5>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.state'):</td>
                                <td class="align-middle">
                                    @if( isset($orderdb->job_status ) )
                                        @if( strtolower($orderdb->job_status  ) == "canceled" )
                                            <label class="error"> {{ $orderdb->job_status  }} </label>
                                        @elseif(  $orderdb->job_status == "Error" || $orderdb->job_status == "Manual")
                                            <label class="error"> @lang('servientrega.orderdetail.nocreate.label') </label>
                                        @endif
                                    @else
                                        <label class="error">Error al generar guía</label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Nombre del destinatario:</td>
                                <td class="align-middle">{{$orderdb->customer}}</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Dirección de destino:</td>
                                <td class="align-middle">{{$orderdb->shipping_address}}</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Generar guía:</td>
                                <td class="align-middle">
                                    @if(isset($order->job_status ))
                                        @if( strtolower($order->job_status  ) == "canceled" )
                                            <form action="" method="post" id="resendForm_{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="guide_number" value="{{$order['shipping_id']}}">
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <input type="submit" value="{{ strtoupper(__('servientrega.buttons.resend')) }}">
                                            </form>
                                        @elseif( strtolower($order->job_status) == "error" )
                                            <form action="{{route('orders.resendServientrega')}}" method="post" id="resendForm_{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <input type="submit" value="{{ strtoupper(__('servientrega.buttons.send')) }}">
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{route('orders.resendServientrega')}}" method="post" id="resendForm_{{$order->id}}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <input type="submit" value="{{ strtoupper(__('servientrega.buttons.send')) }}">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>