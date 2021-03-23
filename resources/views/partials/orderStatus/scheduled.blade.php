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
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.description'):</td>
                            <td class="align-middle">
                            {{ $order["name"]}} 
                            @foreach($order["line_items"] as $item)
                                ({{$item["quantity"]}}) {{$item["title"]}}. 
                            @endforeach

                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.state'):</td>
                            <td class="align-middle">{{$servientregaDelivery->status}}</td>
                        </tr>
                        <tr>
                            @php
                                use Carbon\Carbon;
                                Carbon::setLocale($language);
                            @endphp
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.schedule'):</td>
                            <td class="align-middle">
                                @isset($orderbd->deliverywhen)
                                    @if( $orderbd->deliverywhen != "")
                                        {{ Carbon::createFromFormat('Y-m-d H:i:s',$orderbd->deliverywhen , $storeTimeZone )->isoFormat('LLL') }}
                                    @endif
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.orderid'):</td>
                            <td class="align-middle">{{$servientregaDelivery->id}}</td>
                        </tr>
                        <tr>
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.courier'):</td>
                            <td class="align-middle">
                            @if($servientregaDelivery->driver != null)
                                {{$servientregaDelivery->driver->name}}
                            @else
                                * *
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.phone'):</td>
                            <td class="align-middle">
                            @if($servientregaDelivery->driver != null)
                                {{$servientregaDelivery->driver->phone}}
                            @else
                                * *
                            @endif
                            </td>
                        </tr>
                        @csrf
                    <input type="hidden" name="job_id" value="{{$servientregaDelivery->id}}">
                    <input type="hidden" name="order_id" value="{{$order['id']}}">
                        <tr>
                            <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.state'):</td>
                            <td class="align-middle text-success">{{$servientregaDelivery->deliveries[0]->status}}</td>
                        </tr>
                    </tbody>
                </table>
                <form action="" method="post" id="form_servientrega">
                    @csrf
                    <input type="hidden" name="job_id" value="{{$servientregaDelivery->id}}">
                    <input type="hidden" name="id" value="{{$order['id']}}">
                    <button class="btn btn-primary ml-5 mr-5 mt-4 tip" data-hover="@lang('servientrega.orderdetail.servientregastatus.retry')">@lang('servientrega.buttons.cancel')</button>
                </form>
                @push('customscripts')
                    <script>
                        $('#form_servientrega').submit(function(){
                            $(this).find('button[type=submit]').prop('disabled', true).addClass('disabled');
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
</div>
