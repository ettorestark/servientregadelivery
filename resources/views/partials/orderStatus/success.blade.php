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
                                {{$servientregaDelivery->EstAct}}
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">Remitente:</td>
                                <td class="align-middle">{{$servientregaDelivery->NomRem}}</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Ciudad de remitente:</td>
                                <td class="align-middle">{{$servientregaDelivery->CiuRem}}</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Direccion del remitente:</td>
                                <td class="align-middle">{{$servientregaDelivery->DirRem}}</td>
                            </tr>
                            <tr>
                                <td class="align-middle">Ciudad destino:</td>
                                <td class="align-middle">{{$servientregaDelivery->CiuDes}}</td>
                            </tr>
                            <tr>
                            @foreach ($servientregaDelivery->Mov as $mov)
                                <td class="align-middle">Nombre del movimiento:</td>
                                <td class="align-middle">{{$mov->NomMov}}</td>
                            @endforeach                
                            </tr>
                            <tr>
                                <td class="align-middle">Detalle de envío:</td>
                                <td class="align-middle"><a target="_blank" href="https://www.servientrega.com/wps/portal/Colombia/transacciones-personas/rastreo-envios/detalle?id={{$servientregaDelivery->NumGui}}">Ver detalle</a></td>
                            </tr>
                            <tr>
                                <td class="align-middle">Mostrar sticker de la Guía:</td>
                                <td class="align-middle"><a target="_blank"  href="{{ route('see_pdf_stickers', ['guide_number' =>$orderdb['shipping_id'] ]) }}">Ver sticker</a></td>
                            </tr>
                            {{--
                            <tr>
                                <td class="align-middle">Solicitar recolección:</td>
                                <td class="align-middle">
                                    <input type="submit" value="Solicitar recoleccion"  data-toggle="modal" data-target="#vexsoluciones_modal"> 
                                </td>
                            </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>