@extends('shopify-app::layouts.default')

@section('content')
    <header id="vexsoluciones_header" class="mb-4">
        <article>
            <h2>@lang('servientrega.products.header.title')</h2>
            <h3>@lang('servientrega.products.header.subtitle')</h3>
        </article>
    </header>


    <section id="vexsoluciones_section" class="spy-width-medium-9-10" id="product-list" style="display: block">
            <div id="vexsoluciones_card" class="card">

                <table id="vexsoluciones_products_table" class="table bordered">
                    <thead id="vexsoluciones_thead">
                        <tr>
                            <th></th>
                            <th>@lang('servientrega.products.table.headers.product')</th>
                            <th>@lang('servientrega.products.table.headers.type')</th>
                            <th>@lang('servientrega.products.table.headers.vendor')</th>
                            <th>Dimensiones <span class="tip" data-hover="AltoxLargoxAncho"><img src="{{asset('img/help.svg')}}" alt="interrogation mark" height="16" width="16" /></span></th>
                            <th>@lang('servientrega.products.table.headers.available')</th>
                        </tr>
                    </thead>
                    <tbody id="vexsoluciones_tbody">
                    @isset($products)
                        
                        @foreach($products as $product)
                        @php $enable = false @endphp
                        @php $dimensions = 'No asignadas' @endphp
                        @php $time = null @endphp
                        @php $packagesize = null @endphp
                        <tr>
                            @foreach($productmeta as $meta)
                                @if($meta['PROD_PRODUCT'] == $product['id'])
                                    @if($meta['PROD_METADATA_KEY'] == "available_for_servientrega" )
                                        @php $enable = $meta['PROD_METADATA_VALUE'] @endphp
                                        <input type="hidden" id="enable_{{$product['id']}}" value="{{$meta['PROD_METADATA_VALUE']}}">
                                    @elseif($meta['PROD_METADATA_KEY'] == "dimensions" )
                                        @php $dimensions = $meta['PROD_METADATA_VALUE'] @endphp
                                        <input type="hidden" id="dimensions_{{$product['id']}}" value="{{$meta['PROD_METADATA_VALUE']}}">    
                                    @endif
                                @endif
                            @endforeach
                            <td width="60">
                                <a class="image-ratio image-ratio--square image-ratio--square--50 image-ratio--interactive">
                                    @if ( isset( $product['images']))
                                        <!-- validar si es un array -->
                                        @if(is_array($product['images']) and !empty($product['images'])  )
                                            <img title="{{ $product['title'] }}" class="image-ratio__content" src="{{ $product['images'][0]['src'] }}" id="image-product-{{$product['id']}}">
                                        @endif
                                    @endif
                                </a>
                            </td>
                            <td><a data-product="{{ $product['id'] }}" id="title-product-{{$product['id']}}" data-toggle="modal" data-target="#vexsoluciones_modal" class="title-product">{{ $product['title'] }} </a></td>
                            <td>{{ $product['product_type'] }}</td>
                            <td>{{ $product['vendor'] }}</td>
                            <td>{{$dimensions}}</td>
                            <td>
                                @if( $enable )
                                    Disponible
                                @else
                                    No disponible
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
    </section >


@include('partials.modal')



@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/products.js') }}"></script>

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Products',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);


        function deleteMetaProducto(){
            axios.post('/products/delete', {
                id_meta: $("#id_meta").val(),
                product: $("#id_producto").val()
            })
            .then(function(response){
                console.log(response);
            })
            .catch(function(error){
                console.log(error);
            })
        }
    </script>


@endsection