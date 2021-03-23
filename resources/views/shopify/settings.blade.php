@extends('shopify-app::layouts.default')

@section('content')

<header id="vexsoluciones_header">
    <article>
        <h1 id="vexsoluciones_title">Servientrega delivery for Shopify</h1>
        <h2 id="vexsoluciones_subtitle"><a target="_blank" href="">by Vexsoluciones</a></h2>
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

@if ( $settings and  $settings->getValidated() == false  and $settings->getServientregaApi() and $settings->getServientregaSecret() )
    <section>
        <article>
            <div style="width: 100% !important;" class="alert error">
                <dl>
                    <dd>@lang('servientrega.validated.title')</dd>
                </dl>
            </div>
        </article>
    </section>
@endif


<section class="validated-api d-none">
    <article>
        <div style="width: 100% !important;" class="alert success ">
            <dl>
                <dt> Success!</dt>
            </dl>
        </div>
    </article>
</section>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="vexsoluciones_form" method="POST" action="{{ route('settings.save') }}" class="smart-form " enctype="multipart/form-data"> 
    
    @csrf
    <section id="vexsoluciones_first_section">
        <aside class="vexsoluciones_aside">
            <h2>@lang('servientrega.general.section')</h2>
            <p>@lang('servientrega.general.subsection')</p>
        </aside>
        <article>
            <div class="vexsoluciones_card card">

                <h5 class="vexsoluciones_title">@lang('servientrega.general.basic')</h5>
                <div class="row paddin-top-md">
                    <div class="tip full-width" data-hover="@lang('servientrega.enable.desc')">
                        <label>@lang('servientrega.enable.label'):
                            <input id="SETT_ENABLE" type="radio" class="@error('title') is-invalid @enderror"
                                id="SETT_ENABLE" checked="checked">
                        </label>
                    </div>
                    <em class="small help ">@lang('servientrega.enable.desc')</em>
                </div>


                <div class="row paddin-top-md">
                    <label>@lang('servientrega.language.label') : </label>
                    <div class="tip full-width" data-hover="@lang('servientrega.language.label')">
                        <select class="vexsoluciones_select select-language form-control" name="SETT_LANGUAGE">
                            @foreach ($languages as $language)
                            <option value="{{ $language->LANG_CODE}}" @if( $settings->SETT_LANGUAGE ==
                                $language->LANG_CODE) selected="selected" @endif > {{ $language->LANG_NAME }} </option>
                            @endforeach
                        </select>
                    </div>
                    <em class="small  help ">@lang('servientrega.language.desc')</em>
                </div>

                <div class="row paddin-top-md">
                    <label>@lang('servientrega.method.label')</label>
                    <div class="tip full-width" data-hover="@lang('servientrega.method.desc')">
                        <input required="required" name="SETT_METHOD_TITLE" type="text" value="{{$settings->SETT_METHOD_TITLE}}">
                    </div>
                    <em class="small  help ">@lang('servientrega.method.desc')</em>
                </div>

                <div class="row paddin-top-md">
                    <label>@lang('servientrega.methodDescription.label')</label>
                    <div class="tip full-width" data-hover="@lang('servientrega.methodDescription.desc')">
                        <input required="required" name="SETT_METHOD_DESCRIPTION" type="text" value="{{$settings->SETT_METHOD_DESCRIPTION}}">
                    </div>
                    <em class="small  help ">@lang('servientrega.methodDescription.desc')</em>
                </div>

                <div class="row paddin-top-md">
                    <label>@lang('servientrega.server.label') : </label>
                    <div class="tip  full-width" data-hover="@lang('servientrega.server.desc')">
                        <div class="row">
                            <div class="col-3">
                                <input required="required" name="SETT_SERVER" type="radio" value="Production" 
                                    @if($settings->SETT_SERVER == "Production") checked="checked" @endif>
                                <label class="display-inline">Production</label>

                            </div>

                            <div class="col-3">
                                <input required="required" name="SETT_SERVER" type="radio" value="Test" 
                                @if($settings->SETT_SERVER == "Test") checked="checked" @endif>
                                <label class="display-inline">Testing</label>
                            </div>
                        </div>
                    </div>
                    <em class="small  help ">@lang('servientrega.server.desc')</em>
                </div>

                <div class="vexsoluciones_api api_information">
                    

                    <div class="row paddin-top-md">
                        <label>Usuario servientrega: </label>
                        <div class="inputcontainer">
                            <div class="tip full-width" data-hover="@lang('servientrega.servientregaapi.tip')">
                                <input required="required" maxlength="65" name="SETT_SERVIENTREGA_API" type="text" value="{{$settings->SETT_SERVIENTREGA_API}}">
                            </div>
                            <div class="icon-container d-none">
                                <i class="loader"></i>
                            </div>
                        </div>
                        <p class="mb-0">
                            <em class="small  help ">@lang('servientrega.servientregaapi.desc')</em> &nbsp; &nbsp;<em
                                class="small help"> <br>
                                <a href="https://youtu.be/zMbZ1CuGozU" target="_blank"> Show me how</a>
                            </em>
                        </p>
                    </div>

                    <div class="row paddin-top-md">
                        <label>Contraseña : </label>
                        <div class="inputcontainer">
                            <div class="tip full-width" data-hover="@lang('servientrega.servientregasecret.desc')">
                                <input required="required" maxlength="65" name="SETT_SERVIENTREGA_SECRET" type="password"
                                    value="{{$pwdDesencriptada}}">
                            </div>
                            <div class="icon-container d-none">
                                <i class="loader"></i>
                            </div>
                        </div>
                        <em class="small  help ">@lang('servientrega.servientregasecret.desc')</em>
                    </div>

                    <div class="row paddin-top-md">
                        <label>Codigo de facturación: </label>
                        <div class="inputcontainer">
                            <div class="tip full-width" data-hover="@lang('servientrega.servientregasecret.desc')">
                                <input required="required" maxlength="65" name="SETT_SERVIENTREGA_BILLING_CODE" type="text"
                                    value="{{$settings->SETT_SERVIENTREGA_BILLING_CODE}}">
                            </div>
                            <div class="icon-container d-none">
                                <i class="loader"></i>
                            </div>
                        </div>
                        <em class="small  help ">@lang('servientrega.servientregasecret.desc')</em>
                    </div>
                    {{--
                    <div class="row paddin-top-md">
                        <p>
                            <div class="ml-auto">
                                <button type="button" class="button" id="btn-test-conexion" onclick="validateApi()" disabled>@lang('servientrega.buttons.test')</button>
                            </div>
                        </p>
                    </div>
                    --}}
                    
                </div>



                



                <div class="row paddin-top-md">
                    <label>@lang('servientrega.cost.label')</label>
                    <div >
                        <div class="row">
                            <div class="form-check">
                                <label > <input required="required" @if($settings->SETT_COST_TYPE =="Free" ) checked="checked" @endif name="SETT_COST_TYPE" type="radio" value="Free"> @lang('servientrega.cost.types.free') 
                                <span class="tip" data-hover="@lang('servientrega.cost.help.free')"><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span>
                                </label>
 
                                <label> <input required="required" @if($settings->SETT_COST_TYPE =="Freefor") checked="checked" @endif name="SETT_COST_TYPE" type="radio" value="Freefor">
                                    @lang('servientrega.cost.types.freefor') 
                                    <span class="tip" data-hover="@lang('servientrega.cost.help.freefor')"><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span>
                                </label>

                                <div id="custom-Freefor" class="custom-Freefor" style="height: 32px; display:@if($settings->SETT_COST_TYPE == 'Freefor') block @else none @endif ;">
                                    <div class="col-3 margin-left-25">
                                        <input id="SETT_FREE_FOR_DEFAULT" name="SETT_FREE_FOR_DEFAULT"
                                            type="text" value="{{$settings->SETT_FREE_FOR_DEFAULT}}" >
                                    </div>
                                </div>
                                
                                <label class="mt-2"> <input required="required" @if($settings->SETT_COST_TYPE =="Calculate" ) checked="checked" @endif name="SETT_COST_TYPE" type="radio" value="Calculate">
                                    @lang('servientrega.cost.types.calculate') 
                                    <span class="tip" data-hover="@lang('servientrega.cost.help.calculate')"><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span>
                                
                                </label>
                                <label> <input required="required" @if($settings->SETT_COST_TYPE =="Fixed") checked="checked" @endif name="SETT_COST_TYPE" type="radio" value="Fixed">
                                    @lang('servientrega.cost.types.fixed') 
                                    <span class="tip" data-hover="@lang('servientrega.cost.help.fixed') "><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span>
                                </label>

                                <div id="custom-cost" class="custom-cost" style="height: 32px; display:@if($settings->SETT_COST_TYPE == 'Fixed') block @else none @endif ;">
                                    <div class="col-3 margin-left-25">
                                        <input id="SETT_COST_DEFAULT" name="SETT_COST_DEFAULT"
                                            type="text" value="{{$settings->SETT_COST_DEFAULT}}" >
                                    </div>
                                    <span style="padding: 8px;display: flex;"> </span>
                                </div>

                                <label class="mt-2"> <input required="required" @if($settings->SETT_COST_TYPE =="Percentage") checked="checked" @endif name="SETT_COST_TYPE" type="radio" value="Percentage">
                                    @lang('servientrega.cost.types.percentage')
                                    <span class="tip" data-hover="@lang('servientrega.cost.help.percentage')"><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span>
                                </label>
                                <div id="custom-percentage" class="custom-cost input-group" style="height: 32px; display:@if($settings->SETT_COST_TYPE == 'Percentage') block @else none @endif ;">
                                    <div class="col-3 margin-left-25 form-inline" style="flex-flow: nowrap;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: 1.6rem;">%</div>
                                            </div>
                                        <input id="SETT_PERCENTAGE_DEFAULT" name="SETT_PERCENTAGE_DEFAULT" placeholder="10"
                                            type="number" value="{{$settings->SETT_PERCENTAGE_DEFAULT}}" min="-100" max="100" >
                                            
                                    </div>
                                    
                                </div>
                                <div id="messagePercentage" class="row mt-2" style="display: @if($settings->SETT_COST_TYPE =="Percentage") block; @else none; @endif width: 90%;" >
                                    <em class="small help">@lang('servientrega.cost.messagePercetange') </em><br>
                                </div>

                            </div>
                        </div>
                        <em class="small  help ">@lang('servientrega.cost.desc')</em>

                    </div>

                    <div class="row paddin-top-md pt-5">
                        <label>@lang('servientrega.allowscheduled.label')</label>
                        <div class="tip  full-width" data-hover="@lang('servientrega.allowscheduled.label')">
                            <div class="row">
                                <label><input data-checkbox-allow-scheduled="for" name="SETT_ALLOWSCHEDULED" type="checkbox" {{ ($settings->SETT_ALLOWSCHEDULED)? "checked": "" }} value="{{$settings->SETT_ALLOWSCHEDULED}}">
                                    @lang('servientrega.allowscheduled.label')</label>
                            </div>
                        </div>
                        <em class="small help">@lang('servientrega.allowscheduled.desc')</em><br>
                    </div>


                    <div class="row paddin-top-md">
                        <label>@lang('servientrega.createorderstatus.label') : </label>
                        <div class="tip full-width" data-hover="@lang('servientrega.createorderstatus.label')">
                            <select class="select-hollyday form-control" name="SETT_CREATE_STATUS">
                                @foreach($orderStatus as $status)
                                <option value="{{$status->status}}" @if($status->status == $settings->SETT_CREATE_STATUS ) selected="selected" @endif>{{$status->status}}</option>
                                @endforeach

                            </select>
                        </div>
                        <em class="small  help ">@lang('servientrega.createorderstatus.desc')</em>
                    </div>
                </div>
        </article>
    </section>

    <section id="vexsoluciones_second_section">
        <aside class="vexsoluciones_aside">
            <h2>@lang('servientrega.widget.section')</h2>
            <p>@lang('servientrega.widget.subsection')</p>
        </aside>
        <article>
            <div class="vexsoluciones_card card">

                <h5 class="vexsoluciones_title">@lang('servientrega.widget.basic')</h5>
                

                <div class="row paddin-top-md pt-3">
                    <div class="tip  full-width" data-hover="@lang('servientrega.allowfirstwidget.label')">
                        <div class="row">
                            <label><input data-checkbox-allow-scheduled="for" name="SETT_ALLOWFIRSTWIDGET" type="checkbox" {{ ($settings->SETT_ALLOWFIRSTWIDGET)? "checked": "" }} value="{{$settings->SETT_ALLOWFIRSTWIDGET}}">
                                @lang('servientrega.allowfirstwidget.label')</label>
                        </div>
                    </div>
                    <em class="small help">@lang('servientrega.allowfirstwidget.desc')</em><br>
                </div>

                <div class="row paddin-top-md pt-3">
                    <div class="tip  full-width" data-hover="@lang('servientrega.allowsecondwidget.label')">
                        <div class="row">
                            <label><input data-checkbox-allow-scheduled="for" name="SETT_ALLOWSECONDWIDGET" type="checkbox" {{ ($settings->SETT_ALLOWSECONDWIDGET)? "checked": "" }} value="{{$settings->SETT_ALLOWSECONDWIDGET}}">
                                @lang('servientrega.allowsecondwidget.label')</label>
                        </div>
                    </div>
                    <em class="small help">@lang('servientrega.allowsecondwidget.desc')</em><br>
                </div>


                <div class="row paddin-top-md mb-0">
                    <label>@lang('servientrega.selectImage.label')</label>
                    <div class="custom-file tip full-width" data-hover="@lang('servientrega.selectImage.desc')">
                        <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="es" onChange="img_pathUrl(this);">
                        <label class="custom-file-label" for="customFileLang" id="labelphoto">{{$settings->SETT_IMAGE}}</label>
                    </div>
                    <em class="small help">@lang('servientrega.selectImage.desc')</em>
                </div>
                <div class="row paddin-top-md">
                    <input type="hidden" name="image_name" value="{{$settings->SETT_IMAGE}}">
                    <button type="button" class="button ml-auto"  onclick="deleteImage()">Eliminar Imagen</button>
                </div>
            </div>
        </article>
    </section>

    <section id="vexsoluciones_third_section">
        <aside class="vexsoluciones_aside">
            <h2>@lang('servientrega.locations.section')</h2>
            <p>@lang('servientrega.locations.subsection')</p>
        </aside>

        <article>
            <div class="vexsoluciones_card card full-width clearfix">

                @foreach($locations as $location)

                <input type="text" type="hidden" name="locations[{{$location->getId()}}][id]" value="{{$location->STLO_ID}}" style="display:none;">
    
                <div class="row" id="store-location" data-location-section="">

                    <div class="row columns paddin-top-sm">
                        <div class="columns two"> <label>@lang('servientrega.address.storename')&nbsp: </label></div>
                        <div class="columns eight" data-hover="">
                            <input id="vexsoluciones_storename" class="disabled" readonly="readonly"
                                name="locations[{{$location->getId()}}][name]" type="text" value="{{$location->STLO_NAME}}">
                        </div>
                    </div>

                    <div class="row columns paddin-top-sm">
                        <div class="columns two"> <label>@lang('servientrega.address.city')&nbsp: </label></div>
                        <div class="columns eight" data-hover="">
                            <input id="vexsoluciones_city" class="disabled" readonly="readonly" name="locations[{{$location->getId()}}][city]"
                                type="text" value="{{$location->STLO_CITY}}">

                        </div>
                    </div>

                    <div class="row columns paddin-top-sm">
                        <div class="columns two"> <label>@lang('servientrega.address.address1')&nbsp: </label></div>
                        <div class="columns eight" data-hover="">
                            <input id="vexsoluciones_address1" class="disabled" readonly="readonly"
                                name="locations[{{$location->getId()}}][adress1]" type="text" value="{{$location->STLO_ADDRESS1}}">

                        </div>
                    </div>

                    <div class="row columns paddin-top-sm">
                        <div class="columns two"> <label>@lang('servientrega.address.address2')&nbsp: </label></div>
                        <div class="columns eight" data-hover="">
                            <input id="vexsoluciones_address2" class="disabled" readonly="readonly"
                                name="locations[{{$location->getId()}}][address2]" type="text" value="{{$location->STLO_ADDRESS2}}">

                        </div>
                    </div>


                    <div class="row columns paddin-top-sm">
                        <div class="columns two tip full-width"> <label
                                data-hover="@lang('servientrega.address.country')">@lang('servientrega.address.country')&nbsp:
                            </label></div>
                        <div class="columns three tip full-width" data-hover="@lang('servientrega.address.country')">
                            <div class="display-inline">
                                <input id="vexsoluciones_country" class="disabled" readonly="readonly"
                                    name="locations[{{$location->getId()}}][country]" type="text" value="{{strtoupper($location->STLO_COUNTRY_NAME)}}">
                            </div>
                        </div>
                        <div class="columns three tip full-width" data-hover="@lang('servientrega.address.province')">
                            <div class="display-inline">
                                <input id="vexsoluciones_province" class="disabled" readonly="readonly"
                                    name="locations[{{$location->getId()}}][province]" type="text" value="{{$location->STLO_PROVINCE}}">
                            </div>
                        </div>
                        <div class="columns one tip full-width" data-hover="@lang('servientrega.address.postcode')">
                            <div class="display-inline">
                                <input id="vexsoluciones_postcode" class="disabled" readonly="readonly"
                                    name="locations[{{$location->getId()}}][postCode]" type="text"
                                    value="{{$location->STLO_POSTCODE}}">
                            </div>
                        </div>
                    </div>



                    <div class="row columns paddin-top-sm">
                        <div class="columns two"> <label>@lang('servientrega.address.phone')&nbsp: </label></div>
                        <div class="columns eight" data-hover="">
                            <input id="vexsoluciones_city" class="disabled" readonly="readonly"
                                name="locations[{{$location->getId()}}][phone]" type="text" value="{{$location->STLO_PHONE}}">

                        </div>
                    </div>

                </div>

                <hr class="mb-5 mt-5">
                @endforeach
                <a href="" class="btn button" onclick="window.open( 'https://{{$domain}}/admin/settings/locations' , 'newwindow', 'width=700,height=500'); return false;">Gestionar más sucursales</a>
            </div>
        </article>
    </section>

    <section id="vexsoluciones_quarter_section">
        <aside>
            <h2>@lang("servientrega.workinghours.section") </h2>
            <p>@lang("servientrega.workinghours.subsection")</p>
        </aside>
        <article>
            <div class="vexsoluciones_card card">
            <div class="row mb-0">
                <table class="table daysOfWeek customTD mb-0">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col" class="d-flex align-items-center">Turno 1</th>
                        <th scope="col"></th>
                        <th scope="col" class="d-flex align-items-center" >Turno 2 
                            <label class="vexsoluciones_cart_switch" style="margin-left: 7px;" >
                            <input id="enableDobleTurn" name="days[doubleTurn]" type="checkbox" @if($doubleTurn) checked="checked" @endif >
                            <span class="vexsoluciones_cart_slider round"></span>
                            </label>
                        </th>
                        <th scope="col">
                        </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                            <tr>
                                <th></th>
                                <td>Abierto desde:</td>
                                <td>Cierre:</td>
                                <td> <p class="dobleTurn" @if(!$doubleTurn) style="display:none" @endif >Abierto desde:</p> </td>
                                <td> <p class="dobleTurn" @if(!$doubleTurn) style="display:none" @endif>Cierre: </p> </td>
                            </tr
                        @foreach($workingHours as $workingdays)
                            <tr>
                                <th >
                                    <input data-check-day="" name="days[{{$workingdays['day']}}][enabled]" type="checkbox" value="{{$workingdays['day']}}" @if( $workingdays['enabled'] == true ) checked @endif>
                                    <label class="display-inline"> @lang("servientrega.workinghours.days.{$workingdays['day']}")</label>
                                </th>
                                <td><input class="input-hour"
                                    data-date="{{$workingdays['default'][0]['open']}}" placeholder="HH:MM"
                                    name="days[{{$workingdays['day']}}][open]" type="text"
                                    value="{{$workingdays['hours'][0]['open']}}" ></td>
                                <td><input class="input-hour"
                                    data-date="{{$workingdays['default'][0]['open']}}" placeholder="HH:MM"
                                    name="days[{{$workingdays['day']}}][close]" type="text"
                                    value="{{$workingdays['hours'][0]['close']}}" ></td>
                                <td ><input class="input-hour dobleTurn"
                                    data-date="{{$workingdays['default'][0]['open']}}" placeholder="HH:MM"
                                    name="days[{{$workingdays['day']}}][open2]" type="text"
                                    value="{{$workingdays['hours2'][0]['open']}}"
                                    @if(!$doubleTurn) style="display:none" @endif
                                    ></td>
                                <td ><input class="input-hour dobleTurn"
                                    data-date="{{$workingdays['default'][0]['open']}}" placeholder="HH:MM"
                                    name="days[{{$workingdays['day']}}][close2]" type="text"
                                    value="{{$workingdays['hours2'][0]['close']}}" 
                                    @if(!$doubleTurn) style="display:none" @endif></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

            </div>
        </article>
    </section>
    

    <section id="vexsoluciones_fifth_section">
        <aside>
            <h2>@lang("servientrega.holidays.section")</h2>
            <p>@lang("servientrega.holidays.subsection")</p>
        </aside>
        <article>

            <div class="card hollyday-section">
                <div class="row">
                    <div class="tip full-width" data-hover="@lang('servientrega.holidays.sublabel')">
                        <label>@lang('servientrega.holidays.label') </label>
                    </div>
                    <em class="small help ">@lang('servientrega.holidays.sublabel') <a
                            id="add_holliday" class="btn button text-light">@lang('servientrega.holidays.addbuttom') </a></em>
                </div>

                <div class="row columns paddin-top-sm " id="holidays-form0" style="display: none">
                    <div class="columns one display-inline" data-hover="">
                        <select class="select-holidays form-control">
                            @for ($i = 1; $i <= 31; $i++) 
                            <option value="{{$i}}"> {{sprintf('%02d', $i)}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="columns three display-inline" data-hover="">
                        <select class="select-holidays holiday-month form-control">
                            @foreach($months as $month)
                            <option value="{{$month['id']}}"> {{ $month['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="columns one" data-hover="">
                        <a class="remove_holiday" id="0"> @lang('servientrega.holidays.deletebuttom') </a>
                    </div>
                </div>

                @if( isset($holidays) )
                    @for( $j = 0; $j < count($holidays); $j++ )
                        <div class="row columns paddin-top-sm " id="holidays-form{{$j+1}}">
                            <div class="columns one display-inline" data-hover="">
                                <select class="select-hollyday form-control" name="holidays[day][{{$j+1}}]">
                                    @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN,(int)$holidays[$j]['HODAY_MONTH'],1965) ; $i++) 
                                    <option value="{{sprintf('%02d', $i)}}" @if( $i == (int)$holidays[$j]['HODAY_DAY']) selected="selected" @endif  > {{sprintf('%02d', $i)}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="columns three display-inline" data-hover="">
                                <select class="select-hollyday holiday-month form-control" name="holidays[month][{{$j+1}}]">
                                    @foreach($months as $month)
                                    <option value="{{$month['id']}}" @if($month['id'] == (int)$holidays[$j]['HODAY_MONTH']) selected="selected" @endif > {{ $month['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="columns one" data-hover="">
                                <a class="remove_holiday" id="{{$j+1}}"> @lang('servientrega.holidays.deletebuttom') </a>
                            </div>
                        </div>
                    @endfor
                @endif

                
            </div>
        </article>
    </section>

    <section id="vexsoluciones_sixth_section">
        <article>
            <div class="card">
                <div class="row">
                    <div class="m-auto">
                        <button type="submit" class="tip button"
                            data-hover="@lang('servientrega.buttons.save')">@lang('servientrega.buttons.save')</button>
                    </div>
                </div>
            </div>
        </article>
    </section>


</form>


@endsection

@section('scripts')
@parent
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('js/settings.js') }}"></script>
<script type="text/javascript">
    var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Settings',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

        function validateApi(){
            // axios.post('configureTheme')
            $(".icon-container").removeClass("d-none");
            axios.post('/validate/servientrega', {
                    params: {
                        SETT_SERVER: $("input[name=SETT_SERVER]:checked").val(),
                        SETT_SERVIENTREGA_API: $("input[name=SETT_SERVIENTREGA_API]").val(),
                        SETT_SERVIENTREGA_SECRET: $("input[name=SETT_SERVIENTREGA_SECRET]").val()
                    }
                })
                .then(function(response){
                    if(response['data']['validate']){
                        $(".icon-container").addClass("d-none");
                        $(".validated-api").removeClass("d-none");
                    }
                    else{
                        window.location = "/settings"
                    }
                })
                .catch(function(error){
                });
        }

        function deleteImage(){
            axios.post('/delete_image/', {
                params: {
                    image: $("input[name=image_name]").val(),
                }
            })
            .then(function(response){
                console.log(response);
                if(response['data']['success'] == "ok"){
                    $(".validated-api").removeClass("d-none");
                    $("#labelphoto").text("");
                }
            })
            .catch(function(error){
            });
        }


        function img_pathUrl(input){
            $("#labelphoto").text(input.files[0].name);
        }


</script>


@endsection
