<?php

return [
    'storefront' => [
        'template' => [
            'products' => [
                'available' => 'Este producto está disponible para su entrega por ',
                'choosewhen'=> 'Elije en el proximo paso cuando deseas recibirlo'
            ],
            'cart'      => [
                'loading'=> 'Buscando tiempos de entrega disponibles..',
                'estimated'=> [
                    'hour'  =>'El pedido tardará  <b></b> horas aproximadamente para prepararse',
                    'minute'=>'El pedido tardará <b></b> min aproximadamente en prepararse.',
                    'immediately'=>'<i>El pedido está disponible inmediatamente para la entrega.</i>'
                ],
                'available'=> 'Uno o más de los artículos en su carrito están disponibles para el servicio de entrega por Servientrega.',
                'noallowscheduled'=> '¡Elija envio por Servientrega en el siguiente paso para recibir su pedido!',
                'when' => [
                    'label' => '¿Cuándo le gustaría recibir su pedido?',
                    'question'=>'Elija cuándo desea recibir su pedido.',
                    'assoon'  => 'Enviar lo antes posible'
                ],
                'comment' => "Instrucciones especiales para el vendedor",
                'day'   => 'Día',
                'hour'  => 'Hora'
            ]
        ]
    ],

    'welcome'   => [

        'gettinstarted' => "Guía de inicio",
        'video'         => "https://www.youtube.com/embed/y39kk4CW1M4?autoplay=0&fs=1&iv_load_policy=3&showinfo=1&rel=0&cc_load_policy=0&start=0&end=0",
        'p1'            => "Siga estos pasos para habilitar entregas por el servicio de Servientrega",
        'l1'            => [
            't1'        =>  "Modifica",
            't2'        =>  "Después de instalar la aplicación, se debe de crear un segmento de plantilla llamado",
            't3'        =>  "se instala en el tema default de su tienda. Este fragmento es responsable de mostrar la configuración de entrega  por Servientrega en la página del carrito.",
            't4'        =>  "Para activar el fragmento, abre el <a target=\"blank\" href=\"https://docs.shopify.com/manual/configuration/store-customization/#template-editor\">Theme Editor</a> en el administrador de tu tienda, luego abre <code class=\"code_span\">Templates/cart.liquid</code> y agrega <code class=\"code_span\">{% include 'snippet-servientrega-delivery-cart' %}</code> entre las etiquetas de apertura <code class=\"code_span\">&lt;form&gt;</code> y de cierre <code class=\"code_span\">&lt;/form&gt;</code>.",
            't5'        =>  "La ubicación exacta entre estas etiquetas no es crítica, pero un buen lugar está inmediatamente encima de las notas del carrito o instrucciones especiales (<code class=\"code_span\">{% if settings.show_cart_notes %}</code> <strong>or</strong> <code class=\"code_span\">{% if settings.special_instructions %}</code> <strong>o</strong> <code class=\"code_span\">{% if settings.additional_informaiton %}</code>).",
            't6'        =>  "Por ejemplo:",
            't7'        =>  "Recuera que debes de guardar los cambios despues de modificar la plantilla.",
        ],

        'l2'            => [
            't1'        => 'Ir al  menu settings',
            't2'        => [
                'title' => "Lo primero que debes configurar los accesos para conectarse a la API de Servientrega, por ejemplo, proporcionar las claves de la API de Servientrega. las mismas usadas en el servicio sisclient <a target=\"blank\" href=\"https://canales.servientrega.com/sisclinet/login.aspx\">Servientrega sisclient</a>",
                "helps"     => [
                    'c1'    => '<b>Habilitar el envio:</b> Habilita en la tienda el servicio de entrega utilizando el servicio de Servientrega',
                    'c2'    => '<b>Idioma:</b> Elije el idioma de tu tienda. Por default (Frontstore idioma)',
                    'c3'    => '<b>Título:</b> Es el nombre que aparecera en la tienda para identificar el servicio de servientrega',
                    'c4'    => '<b>Descripción:</b> Es la descripcion que aparecera en la tienda para identificar el servicio de servientrega',
                    'c5'    => '<b>Imagen:</b> Es la imagen que aparecera en la tienda a un lado de la imagen del servicio servientrega',
                    'c6'    => '<b>Servidor:</b> Elige si deseas hacer pruebas seleccionando la opción test',
                    'c7'    => '',
                    'c8'    => '<b>API Servientrega:</b> Proporciona las APIs de Servientrega, la app requiere esta api para realizar pedidos. utiliza los mismos accesos que tu cuenta <a href="https://canales.servientrega.com/sisclinet/login.aspx">Sisclient Servientrega</a>.',
                    'c9'    => '<b>Costo:</b> Elige como deseas cobrar el costo del servicio. 1.- Gratis, 2.-Gratis en compras mayores a cierta cantidad 3.- Calculado por la api de servientrega usando la geolocalización. 3.- Precio fijo 4.- Precio fijo basado en el porcentaje de la compra',
                    'c10'   => '<b>Programar envios:</b> Esta opcion permite al usuario hacer la programación para recibir su orden. De lo contrario se tratara de enviar de inmediato',
                    'c11'   => '<b>Cuando crear la orden:</b> Elije cuando quieres que se realice el pedido de servientrega, 1.- Pago autorizado, 2.- Orden pagada, 3.- Manual',
                ],
            ],

            't3'            => [
                'title'     => "Establezca ubicación de la tienda, los días y horas de trabajo en los que el servicio de entrega por Servientrega estara disponible.",
                "helps"     => [
                    'c1'    => '<b>Ubicación de la tienda:</b> Configura la ubicación de la tienda para que este dentro del área de covertura de Servientrega. Consulta las ciudades con covertura en el <a href="https://www.servientrega.com/wps/portal/Colombia/transacciones-personas/nuestra-red" target="_blank">Sitio web servientrega</a>.',                    
                    'c2'    => 'Si deseas cambiar la ubicación de la tienda sigue los siguientes pasos:',
                    'c3'    => '<b>Días de servicio:</b> Configura los días y horarios de servicio para realizar pedidos de servientrega',
                    'c4'    => '<b>Días festivos:</b> Proporciona los días feriados, en estos días el servicio no estará disponible</a>.',
                ],
            ]

        ],

        'l3'            => [
            't1'        => "Elige los productos que pueden ser enviados a traves del servicio de Servientrega.",
            't2'        => "Configure la disponibilidad de los productos a entregar con el servicio Servientrega.",
            't3'        => "Establecer el tiempo estimado de preparación de los productos disponibles. Para poder ofrecerle el horario de entrega al momento de revisar el carrito."
        ],

        'l4'            => [
            't1'        => "El servicio se activa en el template del producto",
            't2'        => "En la tienda aparecerá la información del producto para ser enviado a travez del servicio de Servientrega",
        ],
        
        'l5'            => [
            't1'        => "Elige cuando deseas recibir tu pedido",
            't2'        => "Si esta activada la configuración de programación de envios, el comprador puede elegir cuando recibira su orden. De lo contrario se enviará lo mas pronto posible",
        ],
        'l6' => [
            't1' => "Configura tu carrito",
            't2' => "1.- Activa tus widgets en la página de configuraciones",
           
        ]





    ],


    'general' => [
        'section'       => 'Configuraciones para servientrega',
        'subsection'    => 'Configuraciones basicas',
        'basic'         => 'Ajuste las configuraciones basicas',

    ],

    'widget' => [
        'section'       => 'Configuración de widgets',
        'subsection'    => 'Define configuraciones básicas de los widgets',
        'basic'         => 'Configuración de los widgets',
    ],

    'allowfirstwidget'    => [
        'label' => 'Mostrar widget en la página de producto',
        'desc'  => '<b>Activo:</b> muestra el widget de servientrega en la página del producto cuando se selecciona un producto disponible para la entrega de servientrega. Nota: activar esta caracteristica es opcional <br><b>Desactivar:</b> el widget no aparecerá '
    ],

    'allowsecondwidget'    => [
        'label' => 'Permitir widget en la página del carrito',
        'desc'  => '<b>Activo:</b> muestra el widget de servientrega en la página del carrito cuando se selecciona al menos un producto disponible para la entrega de servientrega. Note: Es importante para una correcta funcionalidad <br><b>Desactivar:</b> el widget no aparecerá '
    ],
    
    'enable'=> [
        'label'=> 'Habilitar el envío por Servientrega',
        'desc' => '¿Quieres activar el servicio de entrega por Servientrega Delivering?'
    ],

    'language'=> [
        'label'=> 'Elige tu idioma',
        'desc' => 'Elige el idioma principal de la tienda.'
    ],

    'country'=> [
        'label'=> 'Elige tu país',
        'desc' => 'Elige el país de tu tienda'
    ],

    'server'=> [
        'label'=> 'Servidor',
        'desc' => 'Utilizar el servidor productivo o de prueba.'
    ],




    'servientregaapi'=> [
        'label'=> 'Clave API de Servientrega',
        'tip'   => 'Clave API proporcionada por servientrega',
        'desc' => 'Obtenga su clave API en el sitio servientrega <a target="_blank" href="https://dashboard.servientrega.com/log-in"> https://dashboard.servientrega.com/ </a>'
    ],

    'servientregasecret'=> [
        'label'=> 'Clave API Secreta',
        'desc' => 'API Secret proporcionado por servientrega'
    ],

    'googleapi'=> [
        'label'=> 'Clave API de Google Maps',
        'tip' => 'Clave API proporcionada por google maps',
        'desc' => 'Clave API proporcionada por google maps. Obtenga su apikey en el sitio <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"> https://developers.google.com/maps </a>'
    ],


    'method' => [
        'label'=> 'Título del método',
        'desc' => 'Título para el método de entrega de envío servientrega. Cómo verá el cliente el título al realizar la compra'
    ],

    'methodDescription' => [
        'label'=> 'Descripcion del método',
        'desc' => 'Descripción para el método de envío de servientrega'
    ],

    'selectImage' => [
        'label'=> 'Seleccionar imagen',
        'desc' => 'Imagen para el método de envío de servientrega'
    ],

    'cost' => [
        'label'=> 'Costo de envio',
        'desc' => 'Elige la forma de calcular la tarifa de envío.. <br><br> * Tenga en cuenta que Shopify tiene un caché para evitar múltiples solicitudes. Puede tomar unos minutos actualizar las tarifas. Si cambia algún producto en el carrito de compras, se actualizará inmediatamente.',
        'types' => [
            'free'  => "Entrega gratis",
            'freefor'  => "Entrega gratis en compras mayores de",
            'calculate'=> "Calculado por Servientrega API",
            'fixed' => "Basado en un precio fijo",
            'percentage' => "Basado en un porcentaje",
        ],

        'help' => [
            'free'       => "El precio se establecerá en 0",
            'freefor'    => "El precio se establecerá en 0 si la compra es mayor que la cantidad que desea",
            'calculate'  => "Calculado por la API de Servientrega",
            'fixed'      => "Basado en un precio fijo",
            'percentage' => "Basado en un porcentaje",
        ],
        
        'messagePercetange' => "Si desea agregar o descontar un % al precio del api por favor agregue un valor positivo o negativo entre el 1 al 100"


    ],

    'allowscheduled'    => [
        'label'     => 'Permitir programación de envios',
        'desc'      => 'Activa: Permite al comprador elegir hora/día para realizar la programación del envio.<br> Desactiva: Los pedidos se realizaran tan pronto sea posible'
    ],

    'createorderstatus'    => [
        'label'     => 'Crear orden cuando estado sea',
        'desc'      => 'Elige el estado que debe de cumplir  la orden de Shopify para realizar la orden de servientrega'
    ],


    'locations' => [
        'section'       => 'Configurar direcciones de entrega',
        'subsection'    => 'establecer ubicación primaria',
        'coverage'     => 'La ubicación de la tienda debe estar dentro del área de servicio de servientrega. Vea ciudades con cobertura <a href="https://servientrega.com/"> sitio web. </a> ',
        'primary'       => 'Para ubicaciones de edición vaya a Configuración -> Ubicaciones'

    ],


    'address'   => [
        'enable'=> [
            'label'=> 'Habilitar el envío de Servientrega',
            'desc' => '¿Desea activar la entrega de Servientrega para la ubicación de la tienda?'
        ],
        'lat'           => 'Ubicación Lat',
        'lng'           => 'Ubicación Lng',
        'city'          => 'Nombre de la ciudad',
        'storename'     => 'Nombre de la tienda',
        'address1'      => 'Dirección 1',
        'address2'      => 'Dirección 2',
        'postcode'      => 'Código postal',
        'phone'         => 'Teléfono de contacto',
        'country'       => 'Nombre del país',
        'province'      => 'Provincia/Estado',

    ],

    'workinghours'   => [
        'section'       => 'Horas de servicio',
        'subsection'    => 'Establecer días y horarios de trabajo en los que la tienda presta el servicio de entrega.',
        'days'          => [
            '0'    => "Domingo" ,
            '1'    => "Lunes" ,
            '2'    => "Martes" ,
            '3'    => "Miércoles" ,
            '4'    => "Jueves" ,
            '5'    => "Viernes" ,
            '6'    => "Sábado" ,
        ],
        'today'     => 'Hoy',
        'tomorrow'  => 'Mañana'
    ],


    'holidays'   => [
        'section'       => 'Dias feriados',
        'subsection'    => 'Establecer días feriados. En estos días no habrá servicio de entrega.',
        'label'         => 'Establecer días feriados',
        'sublabel'      => 'Agregue los días en que el servicio de servientrega no estará disponible.',
        'addbuttom'     => 'Agregar día feriado',
        'deletebuttom'  => 'Borrar'
    ],

    'months'    => [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ],


    'buttons'       => [
        'save'      => 'Guardar',
        'delete'    => 'Borrar',
        'cancel'    => 'Cancelar',
        'see'       => 'Ver',
        'send'      => 'Enviar',
        'test'      => 'Probar conexión',
        'resend'    => 'Reenviar',
        'next'      => 'Siguiente',
        'previous'  => 'Anterior',
    ],

    'titles'        => [
        'home'      => 'Inicio',
        'settings'  => 'Configuraciones',
        'products'  => 'Productos',
        'orders'    => 'Ordenes'
    ],

    'settings'      => [
        'save'      => [
            'success'   => 'Configuración guardada',
            'failed'    => 'Ocurrio un problema al guardar la configuracion'
        ],
        'messages'      => [
            'required'  => 'Este campo es requerido.'
        ]

    ],


    'validated'         => [
        'title'         => 'No se pudo validar la dirección de la tienda. Asegurate que las credenciales de Servientrega y Google sean correctas. La tienda debe estar dentro el area de servicio de Servientrega, verifica la dirección de la tienda',
    ],

    'validatedplan'         => [
        'noallow'       => 'El plan de tu tienda impide poder realizar el calculo de tarifas calculadas, para poder utilizar esta funcionalidad en el checkout debes de tener un Plan Avanzado o un Plan Anual. Sin embargo las ordenes que se creen las puedes enviar de forma individual a servientrega para su entrega al cliente.'
    ],



    'products'          => [

        'header'        => [
            'title'     => 'Productos',
            'subtitle'  => 'Permite la entrega de productos por parte del servicio de entrega de Servientrega.'
        ],
        'table'         => [
            'headers'   => [
                'product'     => 'Producto',
                'type'        => 'Tipo',
                'vendor'      => 'Vendedor',
                'packagesize' => 'Tamaño del paquete',
                'available'   => 'Disponible para servientrega',


            ]
        ],
        'filters'       => [
            'apply'     => 'Filtrar producto',
            'remove'    => 'Limpiar filtro'
        ]


    ],

    'packagesize'   => [
        'S'       => [
            'label' => 'Pequeño',
            'desc'  => '40cm de largo; 20cm de ancho; 15cm profundidad; 12 kg de peso',
        ],
        'M'       => [
            'label' => 'Mediano',
            'desc'  => '50cm de largo; 30cm de ancho; 30cm profundidad; 20 kg de peso',
        ],
        'L'      => [
            'label' => 'Grande',
            'desc'  => '90cm de largo; 65cm de ancho; 50cm profundidad; 25 kg de peso',
        ], 
        'XL'     => [
            'label' => 'Extra Grande',
            'desc'  => '100cmde largo; 90cm de ancho; 50cm profundidad; 70 kg de peso',
        ]
    
    ],  
    'preparationform' => [
        'modal'         => [
            'title'     => 'Tiempo estimado de preparación.'

        ],

        'enable'        => [
            'label'     => 'Habilitar este producto para la entrega',
            'desc'      => 'Utilice esta opción para habilitar la entrega de este producto por el servicio de entrega de Servientrega',

        ],

        'availability'  => [
            'label'     => 'Inmediatamente',
            'no'        => 'No disponible'

        ],


        'preparation'   => [
            'label'     => 'Tiempo estimado de preparación',
            'desc'      => 'Seleccione el tiempo estimado de preparación del producto. Se utilizará para la disponibilidad de horarios. <br>Por ejemplo, si la tienda cierra a las 10:00 pm y el producto tarda 30 minutos. La hora máxima de servicio será 09:30 PM.',
            'labeldelete'=> 'Eliminar el tiempo estimado'
        ],

        'packagesize'   => [
            'label'     => 'Tamaño del paquete',
            'desc'      => 'Seleccione el tamaño del paquete. Se utilizará para calcular el precio de entrega y seleccionar el transporte adecuado.',
        ],

        'save'          => [
            'success'   => 'La información del producto fue guardada.',
            'error'     => 'Se produjo un error al guardar la información del producto'
        ],
        'delete'          => [
            'success'   => 'La información del producto fue guardada.',
            'error'     => 'Se produjo un error al guardar la información del producto'
        ]
    ],


    'orders'        => [

        'header'        => [
            'title'     => 'Ordenes',
            'subtitle'  => 'Los pedidos que se entregan por Servientrega'
        ],

        'table'         => [
            'headers'   => [
                'order'         => '#Orden',
                'date'          => 'Fecha de entrega',
                'customer'      => 'Cliente',
                'deliveryaddress' => 'Dirección de entrega',
                'paid'          => 'Estado de pago',
                'servientregastatus'   => 'Estado de Servientrega',
                'actions'   => 'Acciones',


            ]
        ]
    ],



    'orderdetail'   => [

        'panel'     => [
            'title' => 'Estado de pedido de Servientrega'
        ],

        'pickupaddress' => [
           'title'          => 'Dirección de origen'
        ],
        'contact' => [
           'title'          => 'Dirección de contacto'
        ],
        'destination' => [
            'title'         => 'Dirección de entrega'
        ],
        'viewmap' => [
            'title'         => 'Ver el mapa'
        ],


        'servientregastatus'       => [
            'state'         => 'Estado',
            'orderid'       => '#Orden Servientrega',
            'schedule'      => 'Hora programada',
            'description'   => 'Descripción',
            'courier'       => 'Nombre del mensajero',
            'phone'         => 'Teléfono',
            'created_at'    => 'Creado en',

            'failedstatus'  => 'Estado del fallo',
            'failedmessage' => 'Mensaje del fallo',
            'retry'         => 'Tratar de reenviar',
            'checklink'     => 'Visita Servientrega Bussines'
        ],

        'nocreate'          => [
            'label'         => 'La orden no ha sido creada en Servientrega',
            'buttom'        => 'Enviar orden a Servientrega'
        ],

        'create'            => [
            'success'       => "Orden # creada exitosamente",
            'fail'          => "Se ha producido un error al procesar el pedido. Con mensaje: "
        ],

        'resend'            => [
            'success'       => "El pedido fue procesado correctamente.",
            'fail'          => "Se ha producido un error al procesar el pedido."
        ],

        'cancel'            => [
            'success'      => "El pedido fue cancelado correctamente.",
            'fail'          => "Se ha producido un error al cancelar el pedido. Con mensaje: "
        ],

        'delivery'          => [
            'scheduled'     => 'La orden fue programada para ser enviada',
            'immmediately'  => 'La orden se enviara',
            'posibility'    => 'La orden puede ser enviada utilizando Servientrega Delivery. Para enviarla manualmente has clic en enviar'
        ],

        'messages' => [
            'new'           => "Hemos aceptado el trabajo y lo asignaremos a un conductor",
            'scheduled'     => "El trabajo ha sido programado. Comenzará más tarde",
            'searching'     => "El trabajo está buscando un conductor",
            'in_progress'   => "El conductor ha aceptado el trabajo y comenzó la entrega",
            'finished'      => "El paquete se entregó con éxito",
            'canceled'      => "El paquete no se entregará porque fue cancelado por el cliente",
            'expired'       => "El trabajo ha expirado. Ningún conductor aceptó el trabajo. No se aplicó ningun costo."
        ]
        

    ],

    'mailsend'          => [
        'ordertitle'        => 'Orden',
        'hello'             => 'Hola',
        'preparing'         => 'Estamos preparando su pedido para recogerlo. Aquí puedes ver el seguimiento del pedido.',
        'thanks'            => 'Gracias por su compra',
        'track_title'       => 'Rastrea tu orden',
        'visit_store'       => 'Visita nuestra tienda',
        'customer_info'     => 'Información al cliente',
        'address_shipping'  => 'Dirección de Envío',
        'address_delivery'  => 'Dirección de Envío...',
        'shipping'          => 'Método de envío',
        'payment'           => 'Método de pago',
        'payment_end'       => 'Termina en',
        'emailcontact'      => 'Si tiene alguna pregunta, responda a este correo electrónico a'
    ],

    'mailtracking'          => [
        'subject'           => 'Rastrea tu pedido: ',
    ],

    'mailfailed'            => [
        'subject'           => 'Error al procesar la orden de Servientrega',
        'title'             => 'Algo salió mal',
        'description'       => 'Se ha producido un error inesperado al intentar procesar el pedido en guante. Por favor ingrese la aplicación para revisar el problema',
        'action'            => 'Resolver el problema'
    ],

    'tracking'              => [
        'ordertitle'        => 'Orden',
        'thanks'            => 'Gracias',
        'thanks_purchase'   => 'Gracias por su compra',
        'order_summary'     => 'Resumen de la orden',
        'order_confirm'     => 'Tu pedido esta confirmado',
        'order_tracking'    => 'Su pedido comenzó a ser entregado, monitorea la ubicación en el mapa',
        'customer_info'     => 'Información al cliente',
        'contact_info'      => 'Información del contacto',
        'address_shipping'  => 'Dirección de Envío',
        'address_delivery'  => 'Dirección de entrega',
        'shipping_method'   => 'Método de envío',
        'payment_method'    => 'Método de pago',
        'payment_end'       => 'Termina en',
        'emailcontact'      => 'Si tiene alguna pregunta, responda a este correo electrónico a',
        'contactus'         => 'Ponte en contacto con nosotros',
        'backstore'         => 'Volver a la Tienda',
        'needhelp'          => '¿Necesitas ayuda?',
        'summary'            => [
            'summary'       => 'Costo total',
            'description'   => 'Descripción',
            'price'         => 'Precio',
            'subtotal'      => 'Subtotal',
            'shipping'      => 'Envío',
            'taxes'         => 'Impuestos',
            'total'         => 'Total',

        ],

        'states'            => [
            'scheduled'     => [
                'title'     => 'Programada',
                'subtitle'  => 'Tu orden se encuentra programada y empezara a procesarse hasta '
            ],
            'active'     => [
                'title'     => 'En progreso',
                'subtitle'  => 'Tu orden se encuentra en proceso de entrega'
            ],
            'delivered'     => [
                'title'     => 'Entregada',
                'subtitle'  => 'La orden ha sido entregada, por el glover: '
            ],
            'canceled'     => [
                'title'     => 'Cancelada',
                'subtitle'  => 'La orden fue cancelada'
            ]

        ],

        'mixed'     => [
            'notes'     => "Nota adicional: "

        ]






    ]

];
