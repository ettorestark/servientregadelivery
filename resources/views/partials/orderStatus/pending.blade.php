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
                        <td class="align-middle">{{$servientregaDelivery->status}}</td>
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
                    <tr>
                        <td class="align-middle">@lang('servientrega.orderdetail.servientregastatus.state'):</td>
                        <td class="align-middle">{{$servientregaDelivery->deliveries[0]->status}}</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
</div>

