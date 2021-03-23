<?php

return [
    'storefront' => [
        'template' => [
            'products' => [
                'available' => 'Ce produit est disponible à la livraison par ',
                'choosewhen'=> 'Choisissez dans le panier quand vous voulez le recevoir'
            ],
            'cart'      => [
                'loading'=> 'Trouver les délais de livraison disponibles ..',
                'estimated'=> [
                    'hour'  => 'La commande prendra environ <b></b> heures pour être préparée.',
                    'minute'=>'La préparation prendra environ <b></b> min.',
                    'immediately'=>'<i> La commande est disponible immédiatement pour la livraison </i>'
                ],
                'available'=> 'Un ou plusieurs articles de votre panier sont disponibles pour le service de livraison de Servientrega.',
                'noallowscheduled'=> 'Choisissez servientrega dans l’étape suivante pour recevoir votre commande!.',
                'when' => [
                    'label' => 'Quand souhaitez-vous recevoir votre commande?',
                    'question'=>'Choisissez quand vous voulez recevoir votre commande.',
                    'assoon'  => 'Envoyer dès que possible'
                ],
                'comment' => "Instructions spéciales au vendeur",
                'day'   => 'Jour',
                'hour'  => 'Heure'
            ]
        ]
    ],

    'welcome'   => [

        'gettinstarted' => "Guide de Démarrage",
        'video'         => "https://www.youtube.com/embed/cwKuLLaSHdE?autoplay=0&fs=1&iv_load_policy=3&showinfo=1&rel=0&cc_load_policy=0&start=0&end=0",
        'p1'            => "Suivez ces étapes pour activer la livraison Shopify Servientrega",
        'l1'            => [
            't1'        =>  "Modifier",
            't2'        =>  "Après l'installation de l'application, un extrait de liquide appelé",
            't3'        =>  "est installé dans votre thème de boutique actuel. Ce fragment de code est chargé d’afficher les paramètres de livraison sur la page du panier.",
            't4'        =>  "Pour activer l'extrait, ouvrez le <a target=\"blank\" href=\"https://docs.shopify.com/manual/configuration/store-customization/#template-editor\">Theme Editor</a> dans votre magasin, puis ouvrez <code class=\"code_span\">Templates/cart.liquid</code> et ajouter <code class=\"code_span\">{% include 'snippet-servientrega-delivery-cart' %}</code> entre l'ouverture <code class=\"code_span\">&lt;form&gt;</code> et la fermeture <code class=\"code_span\">&lt;/form&gt;</code> Mots clés.",
            't5'        =>  "Le placement exact entre ces balises n’est pas critique, mais une bonne place est immédiatement au-dessus des notes du panier ou des instructions spéciales. (<code class=\"code_span\">{% if settings.show_cart_notes %}</code> <strong>ou</strong> <code class=\"code_span\">{% if settings.special_instructions %}</code> <strong>ou</strong> <code class=\"code_span\">{% if settings.additional_informaiton %}</code>).",
            't6'        =>  "Par exemple:",
            't7'        =>  "N'oubliez pas de sauvegarder les modifications lorsque vous avez terminé.",
        ],

        'l2'            => [
            't1'        => 'Aller au menu des paramètres',
            't2'        => [
                'title' => "La première chose à configurer est l’API pour se connecter à l’API Servientrega et à Google Maps. Par exemple, fournissez les clés de l’API Servientrega. <a target=\"blank\" href=\"https://dashboard.servientrega.com/log-in\">Servientrega admin</a>",
                

                "helps"     => [
                    'c1'     => '<b> Activer la livraison: </b> Activer le service de livraison dans le magasin en utilisant le service Servientrega',
                    'c2'     =>'<b> Langue: </b> Choisissez la langue de votre boutique. Par défaut (langue Frontstore) ',
                    'c3'     =>'<b> Titre: </b> C\'est le nom qui apparaîtra dans la boutique pour identifier le service de servientrega',
                    'c4'     =>'<b> Description: </b> C\'est la description qui apparaîtra dans la boutique pour identifier le service de servientrega',
                    'c5'     =>'<b> Image: </b> C\'est l\'image qui apparaîtra dans la boutique à côté de l\'image du service servientrega',
                    'c6'     => '<b> Serveur: </b> Choisissez si vous voulez tester en sélectionnant l\'option de test',
                    'c7'     => '<b> API google maps: </b> fournit l\'API google maps, l\'application nécessite cette API pour la géolocalisation des adresses. Téléchargez une API ici <a href="https://developers.google.com/maps/documentation/embed/get-api-key"> Google Developers </a>. ',
                    'c8'     => '<b> API Servientrega: </b> Fournit les API de Servientrega, l\'application nécessite cette API pour passer des commandes. Obtenez une API ici <a href="https://dashboard.servientrega.com/log-in"> Administrateur Servientrega </a>. ',
                    'c9'     => '<b> Coût: </b> Choisissez comment vous souhaitez facturer le coût du service. 1.- Gratuit, 2.-Gratuit sur les achats supérieurs à un certain montant 3.- Calculé par l\'api de servientrega en utilisant la géolocalisation. 3.- Prix fixe 4.- Prix fixe basé sur le pourcentage de l\'achat ',
                    'c10'    => '<b> Planifier les expéditions: </b> Cette option permet à l\'utilisateur de planifier la réception de sa commande. Sinon, il essaiera d\'envoyer immédiatement ',
                    'c11'    => '<b> Quand créer la commande: </b> Choisissez quand vous voulez que la commande soit faite à partir de servientrega, 1.- Paiement autorisé, 2.- Commande payée, 3.- Manuel',
 
                ],
            ],

            't3'            => [
                'title'     => "Déterminez le lieu, les jours et les heures de travail du magasin dans lesquels le service de livraison de Servientrega sera disponible.",
                "helps"     => [
                    'c1' => '<b> Emplacement du magasin: </b> Définissez l\'emplacement du magasin dans la zone de couverture de Servientrega. Afficher les villes couvertes par <a href="https://servientrega.com/" target="_blank"> Servientrega. </a> ',
                    'c2' => 'Si vous souhaitez modifier l\'emplacement du magasin, procédez comme suit:',
                    'c3' => '<b> Jours de service: </b> Définissez les jours et les heures de service pour commander servientrega',
                    'c4' => '<b> Vacances: </b> Fournit des jours fériés, ces jours-là, le service ne sera pas disponible. </a>',
                ],
            ],

            
        ],

        'l3'            => [
            't1'        => "Choisissez les produits qui peuvent être envoyés par servientrega",
            't2'        => "Configurer la disponibilité des produits à livrer avec le service Servientrega",
            't3'        => "Définissez le temps estimé de préparation des produits disponibles. Pour pouvoir vous proposer le calendrier de livraison lors de la vérification du panier"

        ],

        'l4' => [
            't1'        => "Le service est activé dans le modèle de produit",
            't2'        => "Dans le magasin, les informations sur le produit semblent avoir été envoyées par le service Servientrega",
        ],

        'l5' => [
            't1'        => "Choisissez quand vous voulez recevoir votre commande",
            't2'        => "Si le paramètre de calendrier de livraison est activé, l’acheteur peut choisir quand il recevra sa commande. Sinon, il sera envoyé dès que possible",
        ],
        'l6' => [
            't1' => "Configurez votre panier",
            't2' => "1.- Accédez à votre boutique en ligne, sélectionnez Thèmes> Actions> Modifier le code",
            't3' => "2.- Dans le moteur de recherche, nous chercherons <i> cart-template.liquid </i>, puis nous le sélectionnerons.",
            't4' => "3.- Dans le fichier, nous appuierons sur <b> ctrl + F </b> si vous utilisez windows ou <b> Commande + F </b> si vous êtes sur MAC, une fenêtre s'affichera qui nous permettra faire la recherche. <br>
                     4.- Une fois fait ça, nous rechercherons le texte suivant <i>&#60/form\&#62</i> <br>
                     5.- Juste au-dessus de notre recherche nous mettrons le code suivant <b> {% include 'vexsoluciones-servientrega-delivery-cart.liquid'%} </b> qui nous permettra de modifier notre panier. ",
        ]
    ],

    'general' => [
        'section'       => 'Paramètres Servientrega',
        'subsection'    => 'Définir les paramètres de base',
        'basic'         => 'Paramètres de base',

    ],

    'enable'=> [
        'label'=> 'Activer l\'expédition Servientrega',
        'desc' => 'Voulez-vous activer Servientrega Delivering?'
    ],

    'language'=> [
        'label'=> 'Choisissez une langue',
        'desc' => 'Définir la langue principale du magasin'
    ],

    'country'=> [
        'label'=> 'Choisissez un pays',
        'desc' => 'définir le pays de votre magasin'
    ],

    'server'=> [
        'label'=> 'Serveur',
        'desc' => 'Utiliser le serveur de production ou de test'
    ],




    'stuartapi'=> [
        'label'=> 'Clé API Servientrega',
        'tip'   => 'Clé API fournie par servientrega',
        'desc' => 'Obtenez votre clé api sur le site servientrega <a target="_blank" href="https://dashboard.servientrega.com/log-in"> https://dashboard.servientrega.com/log-in </a>'
    ],

    'stuartsecret'=> [
        'label'=> 'Servientrega API Secret',
        'desc' => 'API Secret fourni par servientrega'
    ],

    'googleapi'=> [
        'label'=> 'Clé API Google Maps',
        'tip' => 'Clé API fournie par google maps',
        'desc' => 'Clé PI fournie par google maps. Obtenez votre apikey sur place <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"> https://developers.google.com/maps </a>'
    ],


    'method' => [
        'label'=> 'Titre de la méthode',
        'desc' => 'Titre du mode de livraison d’expédition de servientrega. Comment le client verra le titre lors du paiement'
    ],

    'methodDescription' => [
        'label'=> 'Description de la méthode',
        'desc' => 'Description pour la méthode Servientrega',
    ],

    'selectImage' => [
        'label'=> 'Sélectionnez une image',
        'desc' => 'Image pour la méthode de livraison servientrega'
    ],

    'cost' => [
        'label'=> 'Coût de livraison',
        'desc' => 'Choisissez le moyen de calculer le taux d\'expédition. <br> <br> * Notez que Shopify a un cache pour éviter les demandes multiples. La mise à jour des taux peut prendre quelques minutes. Si vous modifiez un produit dans le panier, il sera mis à jour immédiatement',
        'types' => [
            'free'  => "Gratuite",
            'freefor'  => "Gratuit sur les achats plus de",
            'calculate'=> "Calculé par l'API Servientrega",
            'fixed' => "Basé sur un prix fixe",
            'percentage' => "Basé sur un porcentage",
        ],
        
        'help' => [
            'free'      => "Le prix sera mis à 0",
            'freefor'   => "Le prix sera mis à 0 si l'achat est plus grand à la quantite que vous voulez",
            'calculate' => "Calculé par l'API Servientrega",
            'fixed'     => "Basé sur un prix fixe",
            'percentage'=> "Basé sur un porcentage",
        ],

        'messagePercetange' => "Si vous souhaitez ajouter ou réduire un% du prix de l'API, veuillez ajouter une valeur positive ou négative entre 1 et 100"

    ],

    'allowscheduled'    => [
        'label'     => 'Autoriser le calendrier des envois',
        'desc'      => 'Actif: Permet à l’acheteur de choisir l’heure / le jour pour planifier l’envoi. <br> Désactiver: les commandes seront passées dès que possible.'
    ],

    'createorderstatus'    => [
        'label'     => 'Créer une commande lorsque le statut est',
        'desc'      => 'Choisissez l\'état que la commande Shopify doit remplir pour exécuter la commande servientrega'
    ],

    'locations' => [
        'section'       => 'Configurer les adresses de livraison',
        'subsection'    => 'définir l\'emplacement principal',
        'coverage'      => 'Le magasin doit être situé dans la zone de service de servientrega. Voir les villes avec une couverture <a href="https://servientrega.com/"> site web servientrega. </a>',
        'primary'       => 'Pour modifier les emplacements, allez à Configuration -> Emplacements'

    ],


    'address'   => [
        'enable'=> [
            'label'=> 'Activer la livraison de Servientrega',
            'desc' => 'Voulez-vous activer Servientrega Delivering pour le magasin?'
        ],
        'lat'           => 'Lieu Lat',
        'lng'           => 'Lieu Lng',
        'city'          => 'Nom de Ville',
        'storename'     => 'Nom du magasin',
        'address1'      => 'Adresse 1',
        'address2'      => 'Adresse 2',
        'postcode'      => 'Code postal',
        'phone'         => 'Numéro du contact',
        'country'       => 'Nom du pays',
        'province'      => 'Province',

    ],

    'workinghours'   => [
        'section'       => 'Heures de service',
        'subsection'    => 'Définir les jours et les horaires de travail dans lesquels le magasin fournit le service de livraison',
        'days'          => [
            '0'    => "Dimanche" ,
            '1'    => "Lundi" ,
            '2'    => "Mardi" ,
            '3'    => "Mercredi" ,
            '4'    => "Jeudi" ,
            '5'    => "Vendredi" ,
            '6'    => "Samedi"
        ],
        'today'     => 'Aujourd\'hui',
        'tomorrow'  => 'Demain'
    ],


    'holidays'   => [
        'section'       => 'Jours fériés',
        'subsection'    => 'Définir des fériés. En ces jours il n\'y aura pas de service de livraison',
        'label'         => 'Définir les fériés',
        'sublabel'      => 'Ajoutez les jours où le service servientrega ne sera pas disponible',
        'addbuttom'     => 'Ajouter les fériés',
        'deletebuttom'  => 'Effacer'
    ],

    'months'    => [
        '01'    => 'Janvier',
        '02'    => 'Février',
        '03'    => 'Mars',
        '04'    => 'Avril',
        '05'    => 'Mai',
        '06'    => 'Juin',
        '07'    => 'Juillet',
        '08'    => 'Août',
        '09'    => 'Septembre',
        '10'    => 'Octobre',
        '11'    => 'Novembre',
        '12'    => 'Décembre',
    ],


    'buttons'       => [
        'save'      => 'Sauvegarder',
        'delete'    => 'Effacer',
        'cancel'    => 'Annuler',
        'see'       => 'Voir',
        'send'      => 'Envoyer',
        'test'      => 'Tester la connexion',
        'resend'    => 'Reenvoyer',
        'next'      => 'Suivant',
        'previous'  => 'Précédent',
    ],

    'titles'        => [
        'home'      => 'Accueil',
        'settings'  => 'Paramètres',
        'products'  => 'Produits',
        'orders'    => 'Ordres'
    ],

    'settings' => [
        'save' => [
            'success'   => 'La configuration a été sauvegardée',
            'failed'    => 'Un problème est survenu lors de l\'enregistrement de la configuration'
        ],
        'messages'      => [
            'required'  => 'Ce champ est requis.'
        ]
    ],

    'validated'         => [
        'title'         => 'Impossible de valider l\'adresse du magasin. Assurez-vous que les informations d\'identification de servientrega et de google sont correctes. Le magasin doit être dans la zone de service de servientrega. Vérifiez l\'adresse du magasin.',
    ],

    'validatedplan'         => [
        'noallow'           => 'Votre plan de magasin vous empêche de calculer les tarifs calculés, afin d\'utiliser cette fonctionnalité lors du paiement, vous devez avoir un plan avancé ou un plan annuel. Cependant, les commandes créées peuvent être envoyées individuellement à servientrega pour livraison au client.'
    ],


    'products'          => [

        'header'        => [
            'title'     => 'Des produits',
            'subtitle'  => 'Permet la livraison des produits par le service de livraison de Servientrega'
        ],
        'table'         => [
            'headers'   => [
                'product'     => 'Produit',
                'type'        => 'Type',
                'vendor'      => 'Vendeur',
                'packagesize' => 'Taille du paquet',
                'available'   => 'Disponible pour servientrega',


            ]
        ],
        'filters'       => [
            'apply'     => 'Filtrer le produit',
            'remove'    => 'Filtre filtrant'
        ]

    ],

    'packagesize'   => [
        'S'      => [
            'label' => 'Petit',
            'desc'  => '40 cm de longueur; 20 cm de largeur; 15 cm de profondeur; Poids 12kg',
        ], 
        'M'      => [
            'label' => 'Moyen',
            'desc'  => '50cm de longueur; 30cm cm de largeur; 30cm de profondeur; 20kg weight',
        ],
        'L'      => [
            'label' => 'Grand',
            'desc'  => '90cm de longueur; 65cm cm de largeur; 50cm de profondeur; 25kg weight',
        ], 
        'XL'      => [
            'label' => 'Extra Large',
            'desc'  => '100cm de longueur; 90cm cm de largeur; 50cm de profondeur; 70kg weight',
        ],  
    ],

    'preparationform' => [
        'modal'         => [
            'title'     => 'Temps de préparation estimé'

        ],

        'enable'        => [
            'label'     => 'Activer ce produit pour la livraison',
            'desc'      => 'Utilisez cette option pour activer la livraison de ce produit par le service de livraison Servientrega.',

        ],

        'availability'  => [
            'label'     => 'Immédiatement',
            'no'        => 'Indisponible'

        ],


        'preparation'   => [
            'label'     => 'Temps de préparation estimé',
            'desc'      => 'Sélectionnez le temps estimé de préparation du produit. Il sera utilisé pour la disponibilité des horaires. <br>Par exemple, si le magasin ferme à 22h00 et que le produit prend 30 minutes. L’heure de service maximum sera 21h30.',
            'labeldelete'=> 'Supprimer le temps estimé'
        ],

        'packagesize'   => [
            'label'     => 'Taille du paquet',
            'desc'      => 'Sélectionnez la taille de l\'emballage. Il sera utilisé pour calculer le prix de livraison et sélectionner le transport adéquat',
        ],

        'save'          => [
            'success'   => 'Les informations sur le produit ont été sauvegardées',
            'error'     => 'Une erreur s\'est produite lors de l\'enregistrement des informations sur le produit.'
        ],
        'delete'          => [
            'success'   => 'Les informations sur le produit ont été sauvegardées',
            'error'     => 'Une erreur s\'est produite lors de l\'enregistrement des informations sur le produit.'
        ]
    ],


    'orders'        => [

        'header'        => [
            'title'     => 'Ordres',
            'subtitle'  => 'Les commandes livrées par servientrega'
        ],

        'table'         => [
            'headers'   => [
                'order'     => '#Ordre',
                'date'      => 'Date de livraison',
                'customer'  => 'Client',
                'deliveryaddress' => 'Adresse de livraison',
                'paid'      => 'Statut de paiement',
                'stuartstatus' => 'Statut Servientrega',


            ]
        ]
    ],



    'orderdetail'   => [

        'panel'     => [
            'title' => 'Statut de la commande Servientrega'
        ],

        'pickupaddress' => [
           'title'          => 'Adresse de ramassage'
        ],
        'contact' => [
           'title'          => 'Adresse de contact'
        ],
        'destination' => [
            'title'         => 'Adresse de livraison'
        ],
        'viewmap' => [
            'title'         => 'Voir la carte'
        ],


        'stuartstatus'       => [
            'state'         => 'Etat',
            'orderid'       => 'Numéro de commande',
            'schedule'      => 'Horaire',
            'description'   => 'La description',
            'courier'       => 'Nom du courrier',
            'phone'         => 'Téléphone',
            'created_at'    => 'Créé à',

            'failedstatus'  => 'Statut échoué',
            'failedmessage' => 'Message échoué',
            'retry'         => 'Essayer de renvoyer',
            'checklink'     => 'Visiter Servientrega Business'
        ],

        'nocreate'          => [
            'label'         => 'La commande n\'a pas encore été créée à Servientrega',
            'buttom'        => 'Créer une commande servientrega'
        ],
        'create'            => [
            'success'       => "Commande créée avec succès",
            'fail'          => "Une erreur s'est produite lors du traitement de la commande. Avec message: "
        ],

        'resend'            => [
            'success'       => "La commande a été traitée correctement.",
            'fail'          => "Une erreur s'est produite lors du traitement de la commande. Avec message: "
        ],

        'cancel'            => [
            'success'       => "La commande a été annulée correctement.",
            'fail'          => "Une erreur s'est produite lors du traitement de la commande. Avec message: "
        ],

        'delivery'          => [
            'scheduled'     => 'La commande devait être livrée à',
            'immmediately'  => 'La commande sera envoyée',
            'posibility'    => 'La commande peut être envoyée via Servientrega Delivery. Pour l\'envoyer manuellement, cliquez sur envoyer'
        ],
        
        'messages' => [
            'new'           => "Nous avons accepté le travail et nous allons l'attribuer à un livreur.",
            'scheduled'     => "Le travail a été planifié. Il démarrera plus tard.",
            'searching'     => "Le travail recherche un livreur.",
            'in_progress'   => "Le chauffeur a accepté le travail et a commencé la livraison.",
            'finished'      => "Le colis a été livré avec succès.",
            'canceled'      => "Le colis ne sera pas livré car il a été annulé par le client.",
            'expired'       => "Le travail a expiré. Aucun chauffeur n'a accepté le travail. Cela ne coûte rien."
        ] 

    ],

    'mailsend'          => [
        'ordertitle'        => 'Ordre',
        'hello'             => 'Bonjour',
        'preparing'         => 'Nous préparons votre commande pour la récupérer. Ici vous pouvez voir le suivi de commande',
        'thanks'            => 'Merci pour votre achat',
        'track_title'       => 'Suivre votre commande',
        'visit_store'       => 'Visitez notre magasin',
        'customer_info'     => 'Informations client',
        'address_shipping'  => 'Adresse de livraison',
        'address_delivery'  => 'Adresse de livraison',
        'shipping'          => 'Méthode d\'envoi',
        'payment'           => 'Mode de paiement',
        'payment_end'       => 'Fini dans',
        'emailcontact'      => 'Si vous avez des questions, répondez à cet email à'
    ],

    'mailtracking'          => [
        'subject'           => 'Suivre votre commande: ',
    ],

    'mailfailed'            => [
        'subject'           => 'Impossible de traiter la commande Servientrega',
        'title'             => 'Quelque chose a mal tourné',
        'description'       => 'Une erreur inattendue s\'est produite lors de la tentative de traitement de la commande dans le gant. S\'il vous plaît entrer l\'application pour examiner le problème',
        'action'            => 'Résoudre le problème'
    ],

    'tracking'              => [
        'ordertitle'        => 'Ordre',
        'thanks'            => 'Merci',
        'thanks_purchase'   => 'Merci pour votre achat',
        'order_summary'     => 'Récapitulatif de la commande',
        'order_confirm'     => 'Votre commande est confirmée',
        'order_tracking'    => 'Votre commande a commencé à être livrée, surveille l\'emplacement sur la carte',
        'customer_info'     => 'Informations client',
        'contact_info'      => 'Informations de contact',
        'address_shipping'  => 'Adresse de livraison',
        'address_delivery'  => 'Adresse de livraison',
        'shipping_method'   => 'Méthode d\'envoi',
        'payment_method'    => 'Mode de paiement',
        'payment_end'       => 'Fini dans',
        'emailcontact'      => 'Si vous avez des questions, répondez à cet email à',
        'contactus'         => 'Prenez contact avec nous',
        'backstore'         => 'Retour au magasin',
        'needhelp'          => 'Besoin d\'aide pour?',
        'summary'            => [
            'summary'       => 'Résumé des coûts',
            'description'   => 'La description',
            'price'         => 'Prix',
            'subtotal'      => 'Subtotal',
            'shipping'      => 'Livraison',
            'taxes'         => 'Les taxes',
            'total'         => 'Total',

        ],

        'states'            => [
            'scheduled'     => [
                'title'     => 'Livraison prévue',
                'subtitle'  => 'Votre commande commencera à traiter jusqu\'au'
            ],
            'active'     => [
                'title'     => 'En cours',
                'subtitle'  => 'La commande a commencé le processus de livraison'
            ],
            'delivered'     => [
                'title'     => 'Livré',
                'subtitle'  => 'La commande a été livrée, par le messager:'
            ],
            'canceled'     => [
                'title'     => 'Annulé',
                'subtitle'  => 'La commande ne peut pas être traitée et a été annulée'
            ]

        ]

    ],

    'mixed'     => [
        'notes'     => "Remarque additionnelle: "

    ]

];
