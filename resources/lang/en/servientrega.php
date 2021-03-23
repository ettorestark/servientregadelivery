<?php

return [
    'storefront' => [
        'template' => [
            'products' => [
                'available' => 'This product is available for delivery by ',
                'choosewhen'=> 'Choose in the cart when you want to receive it'
            ],
            'cart'      => [
                'loading'=> 'Finding available delivery times..',
                'estimated'=> [
                    'hour'  => 'The order will take approximately <b></b> hours to prepare',
                    'minute'=>'The order will take approximately <b></b> min to prepare.',
                    'immediately'=>'<i>The order is available immediately for delivery</i>'
                ],
                'available'=> 'One or more of the items in your cart are available for Servientrega delivery service.',
                'noallowscheduled'=> 'Choose servientrega in the next step to receive your order!.',
                'when' => [
                    'label' => 'When would you like to receive your order?',
                    'question'=>'Choose when you want to receive your order.',
                    'assoon'  => 'Send as soon as possible'
                ],
                'comment' => "Special instructions for the seller",
                'day'   => 'Day',
                'hour'  => 'Hour'
            ]
        ]
    ],

    'welcome'   => [

        'gettinstarted' => "Getting Started Guide",
        'video'         => "https://www.youtube.com/embed/yY_At-PEYa8?autoplay=0&fs=1&iv_load_policy=3&showinfo=1&rel=0&cc_load_policy=0&start=0&end=0",
        'p1'            => "Follow these steps to enable Servientrega Delivery",
        'l1'            => [
            't1'        =>  "Modify",
            't2'        =>  "After installing the application, a liquid snippet called",
            't3'        =>  "is installed in your current shop theme. This snippet is responsible for displaying the delivery settings on the cart page.",
            't4'        =>  "To activate the snippet, open the <a target=\"blank\" href=\"https://docs.shopify.com/manual/configuration/store-customization/#template-editor\">Theme Editor</a> in your store admin, then open <code class=\"code_span\">Templates/cart.liquid</code> and add <code class=\"code_span\"> {% include 'snippet-servientrega-delivery-cart' %} </code> between the opening <code class=\"code_span\">&lt;form&gt;</code> and the closing <code class=\"code_span\">&lt;/form&gt;</code> tags.",
            't5'        =>  "Exact placement between these tags isn't critical but a good place is immediately above the cart notes or special instructions (<code class=\"code_span\">{% if settings.show_cart_notes %}</code> <strong>or</strong> <code class=\"code_span\">{% if settings.special_instructions %}</code> <strong>or</strong> <code class=\"code_span\">{% if settings.additional_informaiton %}</code>).",
            't6'        =>  "For example:",
            't7'        =>  "Remember to save changes when you are done.",
        ],

        'l2'            => [
            't1'        => 'Go to the settings menu',
            't2'        => [
                'title' => "The first thing to configure is the APIS to connect to the Servientrega API and Google Maps, for example provide the Servientrega API keys . <a target=\"blank\" href=\"https://servientrega.com/login\">Servientrega</a>",
                "helps"     => [
                    'c1'    => '<b>Enable service: </b> Enable in your store delivery service using the Servientrega',
                    'c2'    => '<b>Language: </b> Choose the language of your store. By default (Frontstore language)',
                    'c3'    => '<b>Title </b> Is the name that will appear in the store to identify the servientrega service',
                    'c4'    => '<b>Description </b> Is the description that will appear in the store to identify the servientrega service',
                    'c5'    => '<b> Image: </b> Is the image that appears in the store next to the image of the servientrega service',
                    'c6'    => '<b>Server </b> Choose if you want to test by selecting the test option',
                    'c7'    => '<b>Google maps API: </b> Provide the google maps API, the app requires this api for address geo-location. Get an api <a href="https://developers.google.com/maps/documentation/embed/get-api-key"> Google Developers </a>.',
                    'c8'    => '<b>Servientrega API: </b> Provides Servientrega APIs, the app requires this app to place orders. Get an api <a href="https://admin.servientrega.com/clients/sign_up">Servientrega admin</a>.',
                    'c9'    => '<b>Cost</b> Choose how you want to calculate the cost of the service. 1.- Free, 2.-Free on purchases over a certain amount 3.- Calculated by the api of servientrega using geolocation. 3.- Fixed price 4.- Fixed price based on the percentage of the purchase',
                    'c10'    => '<b>Schedule delivery </b> This option allows the user to do the programming to receive their order. Otherwise it will try to send immediately',
                    'c11'   => '<b>When to create the order </b> Choose when you want the servientrega order placed, 1.- Authorized payment, 2.- Paid order, 3.- Manual',                  
                ],
            ],

            't3'            => [
                'title'     => "Set locations, days and working hours in which there is delivery and rest days in which there will be no delivery",
                "helps"     => [
                    'c1'    => '<b> Store location: </b> Set the store location to be within Servientregap\'s coverage area. See cities with coverage <a href="https://servientrega.com/" target="_blank"> Website servientrega </a>. ',
                    'c2'    => 'If you want to change the store location follow the steps below:',
                    'c3'    => '<b> Days of service: </b> Configure the days and hours of service for ordering servientrega',
                    'c4'    => '<b> Holidays: </b> Provide holidays, these days the service will not be available </a>.',
                ],
            ],
        ],

        'l3'            => [
            't1'        => "Choose the products that can be sent by servientrega",
            't2'        => "Configure the availability of the products to be delivered with the Servientrega service",
            't3'        => "Set the estimated time of preparation of the available products. To be able to offer you the delivery schedule when checking the cart"
        ],

        'l4'            => [
            't1'        => "The service is activated in the product template",
            't2'        => "The product information will appear in the store front to be sent through the Servientrega service",
        ],

        'l5'            => [
            't1'        => "Choose when you want to receive your order",
            't2'        => "If the delivery schedule setting is activated, the buyer can choose when he will receive his order. Otherwise it will be sent as soon as possible",
        ],

        'l6' => [
            't1' => "Configure your cart",
            't2' => "1.- Enter to your Online store, select Themes> Actions> Edit code",
            't3' => "2.- In the search engine we will search for <i> cart-template.liquid </i>, then we will select it.",
            't4' => "3.- Inside the file we will press <b> ctrl + F </b> for windows or <b> Command + F </b> in MAC, a window will be displayed that will allow us to search. <br>
                     4.- Once there we will search for the following text <i>&#60/form\&#62</i> <br>
                     5.- Just above our search we will put the following code <b> {% include 'vexsoluciones-servientrega-delivery-cart.liquid'%} </b> which will allow us to modify our cart.",
        ]
    ],


    'general' => [
        'section'       => 'Servientrega settings',
        'subsection'    => 'Set basic settings',
        'basic'         => 'Basic settings',

    ],

    'enable'=> [
        'label'=> 'Enable Servientrega Shipping',
        'desc' => 'Do you want to activate Servientrega Delivering?'
    ],

    'language'=> [
        'label'=> 'Choose an language',
        'desc' => 'Define the main language of the store'
    ],

    'country'=> [
        'label'=> 'Choose a country',
        'desc' => 'Define your country of the store'
    ],

    'server'=> [
        'label'=> 'Server',
        'desc' => 'Use the productive or test server'
    ],


    

    'servientregaapi'=> [
        'label'=> 'Servientrega API Key',
        'tip'   => 'API Key provided by servientrega',
        'desc' =>  'Get your api key on servientrega site <a target="_blank" href="https://dashboard.servientrega.com/log-in"> https://dashboard.servientrega.com/ </a>'
    ],

    'servientregasecret'=> [
        'label'=> 'Servientrega API Secret',
        'desc' => 'API Secret provided by servientrega'
    ],

    'googleapi'=> [
        'label'=> 'Google Maps API Key',
        'tip' => 'API Key provided by google maps',
        'desc' => 'API Key provided by google maps. Get your apikey on site <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"> https://developers.google.com/maps </a>'
    ],


    'method' => [
        'label'=> 'Title of the method',
        'desc' => 'Title for the servientrega shipping delivery method. How the client will see the title when doing the checkout'
    ],

    'methodDescription' => [
        'label'=> 'Description of the method',
        'desc' => 'Description for the servientrega shipping delivery method'
    ],

    'selectImage' => [
        'label'=> 'Select an image',
        'desc' => 'Image for servientrega shipping delivery method'
    ],

    'cost' => [
        'label'=> 'Cost of delivering',
        'desc' => 'Choose the way to calculate the shipping rate. <br><br> * Note that Shopify has a cache to avoid multiple requests. It may take a few minutes to update the rates. If you change any product in the shopping cart, it will be updated immediately',
        'types' => [
            'free'  => "Free",
            'freefor'  => "Free on purchases over ",
            'calculate'=> "Calculated by Servientrega API",
            'fixed' => "Based on a fixed price",
            'percentage' => "Based on a percentage",
        ],
        'help' => [
            'free'       => "The price will be set to 0",
            'freefor'    => "The price will be set to 0 if the purchase is larger than the quantity you want",
            'calculate'  => "Calculated by the Servientrega API",
            'fixed'      => "Based on a fixed price",
            'percentage' => "Based on a percentage",
        ],
        'messagePercetange' => "If you want to add or discount a % to the price of the api please add a positive or negative value between 1 to 100"
    ],

    'allowscheduled'    => [
        'label'     => 'Allow delivery schedule',
        'desc'      => 'Active: Allows the buyer to choose day/time to schedule the delivery. <br> Deactivate: Orders will be placed as soon as possible'
    ],

    'widget' => [
        'section'       => 'widgets settings',
        'subsection'    => 'Set basic widgets settings',
        'basic'         => 'widgets settings',
    ],

    'allowfirstwidget'    => [
        'label'     => 'Show widget in product page',
        'desc'      => '<b>Active:</b> Show the stuart widget in product page when a product available for stuart delivery is selected. Note: optional <br> <b>Deactivate:</b> widget will not appear'
    ],

    'allowsecondwidget'    => [
        'label'     => 'Show widget in cart page',
        'desc'      => '<b>Active:</b> Show the stuart widget in cart page when at less a product available for stuart delivery is selected. Note: It is important to activate it for correct functionality <br> <b>Deactivate:</b> widget will not appear'
    ],

    'createorderstatus'    => [
        'label'     => 'Create order when status equals',
        'desc'      => 'Choose the status that the Shopify order must fulfill to start the servientrega order'
    ],

    'locations' => [
        'section'       => 'Configure delivery addresses',
        'subsection'    => 'set primary location',
        'coverage'      => 'The store location must be within the servientrega service area. See cities with coverage <a href="https://servientregaapp.com/en/map"> Coverage map. </a>',
        'primary'       => 'For editing locations go to Settings -> Locations'

    ],


    'address'   => [
        'enable'=> [
            'label'=> 'Enable Servientrega Delivery',
            'desc' => 'Do you want to activate Servientrega Delivering for store location?'
        ],
        'lat'           => 'Location Lat',
        'lng'           => 'Location Lng',
        'city'          => 'City name',
        'storename'     => 'Store name',
        'address1'      => 'Address 1',
        'address2'      => 'Address 2',
        'postcode'      => 'Postal Code',
        'phone'         => 'Contact phone',
        'country'       => 'Country name',
        'province'      => 'Province',

    ],

    'workinghours'   => [
        'section'       => 'Working hours',
        'subsection'    => 'Set days and work schedules in which the store provides the delivery service',
        'days'          => [
            '0'    => "Sunday" ,
            '1'    => "Monday" ,
            '2'    => "Tuesday" ,
            '3'    => "Wednesday" ,
            '4'    => "Thursday" ,
            '5'    => "Friday" ,
            '6'    => "Saturday"
        ],
        'today'     => 'Today',
        'tomorrow'  => 'Tomorrow'
    ],


    'holidays'   => [
        'section'       => 'Holidays',
        'subsection'    => 'Set holidays. In these days there will be no delivery service',
        'label'         => 'Set the holidays',
        'sublabel'      => 'Add the days when the servientrega service will not be available',
        'addbuttom'     => 'Add holiday',
        'deletebuttom'  => 'Delete'
    ],

    'months'    => [
        '01'    => 'January',
        '02'    => 'February',
        '03'    => 'March',
        '04'    => 'April',
        '05'    => 'May',
        '06'    => 'June',
        '07'    => 'July',
        '08'    => 'August',
        '09'    => 'September',
        '10'    => 'October',
        '11'    => 'November',
        '12'    => 'December',
    ],


    'buttons'       => [
        'save'      => 'Save',
        'delete'    => 'Delete',
        'cancel'    => 'Cancel',
        'see'       => 'See',
        'send'      => 'Send',
        'test'      => 'Test connection',
        'resend'    => 'Resend',
        'next'      => 'Next',
        'previous'  => 'Previous',
    ],

    'titles'        => [
        'home'      => 'Home',
        'settings'  => 'Settings',
        'products'  => 'Products',
        'orders'    => 'Orders'
    ],


    'settings'      => [
        'save'      => [
            'success'   => 'The configuration was saved',
            'failed'    => 'There was a problem saving the configuration'
        ],
        'messages'      => [
            'required'  => 'This field is required.'
        ]
    ],

    'validated'         => [
        'title'         => 'Could not validate store address. Make sure the credentials of servientrega and google are correct. The store must be within the servientrega service area (https://servientrega.com/).  Verify the address of the store is real, the city, street, cp, etc.',
    ],

    'validatedplan'         => [
        'noallow'       => 'Your store plan prevents you from calculating calculated rates, in order to use this functionality at checkout you must have an Advanced Plan or an Annual Plan. However, the orders that are created can be sent individually to servientrega for delivery to the customer.'
    ],


    'products'          => [

        'header'        => [
            'title'     => 'Products',
            'subtitle'  => 'Enables the delivery of products by the Servientrega delivery service'
        ],
        'table'         => [
            'headers'   => [
                'product'     => 'Product',
                'type'        => 'Type',
                'vendor'      => 'Vendor',
                'packagesize' => 'Package size',
                'available' => 'Available for servientrega',


            ]
        ],
        'filters'       => [
            'apply'     => 'Filter product',
            'remove'    => 'Clear Filter'
        ]

    ],

    'packagesize'   => [
        'S'      => [
            'label' => 'Small',
            'desc'  => '40cm length; 20cm width; depth 15 cm; 12kg weight',
        ],
        'M'      => [
            'label' => 'Medium',
            'desc'  => '50cm length; 30cm width; 30cm depth; 20kg weight',
        ], 
        'L'      => [
            'label' => 'Large',
            'desc'  => '90cm length; 65cm width, depth 50cm; 25kg weight',
        ],  
        'XL'     => [
            'label' => 'Extra Large',
            'desc'  => '100cm length; 90cm width, depth 50cm; 70kg weight',
        ]
    ],

    'preparationform' => [
        'modal'         => [
            'title'     => 'Estimated time of preparation'

        ],

        'enable'        => [
            'label'     => 'Enable this product for delivery',
            'desc'      => 'Use this option to enable the delivery of this product by Servientrega delivery service',

        ],

        'availability'  => [
            'label'     => 'Immediately',
            'no'        => 'Not available'

        ],


        'preparation'   => [
            'label'     => 'Estimated time of preparation',
            'desc'      => 'Select the estimated time of product preparation. It will be used for the availability of schedules. <br> For example, if the store closes at 10:00 PM, and the product takes 30 minutes. The maximum service hour will be 09:30 PM',
            'labeldelete'=> 'Delete Estimated time'
        ],

        'packagesize'   => [
            'label'     => 'Package size',
            'desc'      => 'Select the package size. It will be used for calculated the price of delivery and select the adequate transport',
        ],

        'save'          => [
            'success'   => 'Product information was saved',
            'error'     => 'An error occurred while saving product information'
        ],
        'delete'          => [
            'success'   => 'Product information was saved',
            'error'     => 'An error occurred while saving product information'
        ]
    ],


    'orders'        => [

        'header'        => [
            'title'     => 'Orders',
            'subtitle'  => 'Orders that are delivered by servientrega'
        ],

        'table'         => [
            'headers'   => [
                'order'     => '#Order',
                'date'      => 'Delivery Date',
                'customer'  => 'Customer',
                'deliveryaddress' => 'Delivery Address',
                'paid'      => 'Payment Status',
                'servientregastatus' => 'Servientrega Status',
                'actions' => 'Actions',


            ]
        ]
    ],



    'orderdetail'   => [

        'panel'     => [
            'title' => 'Servientrega Order Status'
        ],

        'pickupaddress' => [
           'title'          => 'Pickup Address'
        ],
        'contact' => [
           'title'          => 'Contact Address'
        ],
        'destination' => [
            'title'         => 'Delivery Address'
        ],
        'viewmap' => [
            'title'         => 'View map'
        ],
        'servientregastatus'       => [
            'state'         => 'State',
            'orderid'       => 'Order Id',
            'schedule'      => 'ScheduleTime',
            'description'   => 'Description',
            'courier'       => 'Courier name',
            'phone'         => 'Phone',
            'created_at'    => 'Created At',

            'failedstatus'  => 'Failed status',
            'failedmessage' => 'Failed message',
            'retry'         => 'Try to resend',
            'checklink'     => 'Visit Servientrega Bussines'
        ],

        

        'nocreate'          => [
            'label'         => 'The order has not been created in Servientrega yet.',
            'buttom'        => 'Create servientrega order'
        ],
        'create'            => [
            'success'       => "Order created successfully",
            'fail'          => "An error occurred while processing the order. With message: "
        ],

        'resend'            => [
            'success'       => "The order was processed correctly.",
            'fail'          => "An error occurred while processing the order. With message: "
        ],

        'cancel'            => [
            'success'       => "The order was canceled correctly.",
            'fail'          => "An error occurred while processing the order. With message: "
        ],

        'delivery'          => [
            'scheduled'     => 'The order was scheduled to be delivered at',
            'immmediately'  => 'The order will be sent',
            'possibility'   => 'The order can be sent using Servientrega Delivery. To send it manually, click send',
            'pending'                 => 'The Delivery has not started yet.',
            'picking'                 => 'The Delivery has not started yet.',
            'almost_picking'          => 'The driver is en route to pick up the package .',
            'waiting_at_pickup'       => 'The driver is close to the pickup point.',
            'delivering'              => 'The driver has picked the package and is en route to the delivery point.',
            'almost_delivering'       => 'The driver is close to the delivery point.',
            'waiting_at_dropoff'      => 'The driver is close to the delivery point.',
            'delivered'               => 'The package has been delivered successfully.',
            'cancelled'               => 'The delivery was cancelled.',
        ],

        'messages'          =>[
            'new'           => "We've accepted the job and will be assigning it to a driver.",
            'scheduled'     => "The job has been scheduled. It will start later.",
            'searching'     => "The job is looking for a driver.",
            'in_progress'   => "Driver has accepted the job and started the delivery.",
            'finished'      => "The package was delivered successfully.",
            'canceled'      => "The package won't be delivered as it was cancelled by the client.",
            'expired'      => "Job has expired. No driver accepted the job. It didn't cost any money."
        ]

    ],

    'mailsend'          => [
        'ordertitle'        => 'Order',
        'hello'             => 'Hello',
        'preparing'         => 'We are preparing your order to pick it up. Here you can see the order tracking',
        'thanks'            => 'Thanks for your purchase',
        'track_title'       => 'Track your order',
        'visit_store'       => 'Visit our store',
        'customer_info'     => 'Customer information',
        'address_shipping'  => 'Shipping Address',
        'address_delivery'  => 'Delivery Address',
        'shipping'          => 'Shipping method',
        'payment'           => 'Payment method',
        'payment_end'       => 'Ends in',
        'emailcontact'      => 'If you have any questions, reply to this email to'
    ],

    'mailtracking'          => [
        'subject'           => 'Tracking your order: ',
    ],

    'mailfailed'            => [
        'subject'           => 'Servientrega Order Failed',
        'title'             => 'Something went wrong',
        'description'       => 'An unexpected error occurred when trying to process the order in servientrega. Please enter the application to review the problem',
        'action'            => 'Solve the problem'
    ],

    'tracking'              => [
        'ordertitle'        => 'Order',
        'thanks'            => 'Thanks',
        'thanks_purchase'   => 'Thanks for your purchase',
        'order_summary'     => 'Order summary',
        'order_confirm'     => 'Your order is confirmed',
        'order_tracking'    => 'Your order started to be delivered, monitors the location on the map',
        'customer_info'     => 'Customer information',
        'contact_info'      => 'Contact information',
        'address_shipping'  => 'Shipping Address',
        'address_delivery'  => 'Delivery Address',
        'shipping_method'   => 'Shipping method',
        'payment_method'    => 'Payment method',
        'payment_end'       => 'Ends in',
        'emailcontact'      => 'If you have any questions, reply to this email to',
        'contactus'         => 'Get in contact with us',
        'backstore'         => 'Return to the store',
        'needhelp'          => 'Need help?',
        'summary'            => [
            'summary'       => 'Cost Summary',
            'description'   => 'Description',
            'price'         => 'Price',
            'subtotal'      => 'Subtotal',
            'shipping'      => 'Shipping',
            'taxes'         => 'Taxes',
            'total'         => 'Total',

        ],

        'states'            => [
            'scheduled'     => [
                'title'     => 'Your order is scheduled',
                'subtitle'  => 'Your order will start processing until'
            ],
            'active'     => [
                'title'     => 'In process',
                'subtitle'  => 'The order has started the delivery process'
            ],
            'delivered'     => [
                'title'     => 'Delivered',
                'subtitle'  => 'The order has been delivered, by the courier:'
            ],
            'canceled'     => [
                'title'     => 'The order was canceled',
                'subtitle'  => 'The order can not be processed and has been canceled'
            ]

        ]
    ],

    'mixed'     => [
        'notes'             => "Aditional note: ",
        'contactperson'     => "Contact phone",
        'contactphone'      => "Contact person",

    ]


];
