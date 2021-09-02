#Test Technique


![https://i.gyazo.com/10042a2d53f1b8dc77a29b65c302e5a0.png](https://i.gyazo.com/10042a2d53f1b8dc77a29b65c302e5a0.png)

https://gyazo.com/f0e18ac1ad6da4ffef2125584d09bff4
#Partie 1:
  Erreur survenur impossible d'en trouver la source :
    - Ne trouve pas la classe Acme\SyliusStripeGatewayPlugin\Payum\SyliusStripePaymentGatewayFactory dans son namespace malgré son ajout dans lautoload
  
  ![https://i.gyazo.com/f0e18ac1ad6da4ffef2125584d09bff4.png](https://i.gyazo.com/f0e18ac1ad6da4ffef2125584d09bff4.png)
  explication:
    - afin de rajouter le paiment par reccurence(les abonnement) j'ai voulu créer ma GatewayFactory (en plugin sylius) et l'inclure a sylius malheureseument au moment de confirmer le paiment lorquon appuie sur le bouton ma classe qui se trouve pourtant bien au bon endroit n'est pas trouve et donc une erreur survient.suite au manque de temps du au performence de mon pc le manque de documention sur pourquoi l'erreur survient alors qu'elle ne devrait pas(vu que jai suivis pas a pas la doc de sylius) etc je push neamoins ce que jai pu accomplir (c'est a dire l'integration visuel du moyen de paiement paiment (en admin et en selection du moyen de paiement))

  tout les document servant a la partie 1 ce trouve dans le dossier suivant : ./sylius-standard

#Partie 2:

pour utiliser le puble veuiller update la config avec vos clef API dans (./bundle/config/packages/stripe.yaml)(les clef se trouvant actulement dans le fichier ont était changé) laisser le reste tel quel pour juste essayer le bundle.

le code du bundle se trouve dans le dossier .bundle/lib/Acme

si vous copier se code ailleur veuiller creer le fichier config et inclure le bundle dans ./bundle/config/bundles.php de la maniere suivante: 
  Acme\StripeBundle\StripeBundle::class => ['all' => true],

et veuillez par ailleur ajouté l'autoload du namespace Acme vers lib/Acme dans le composer.json et ajouté la definition des routes dans ./bundle/config/routes.yaml de la maniere suivante :
  stripe:
    resource: "@StripeBundle/Resources/config/routes.yaml"
 