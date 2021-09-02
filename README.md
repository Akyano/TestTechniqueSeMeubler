#Test Technique


![https://i.gyazo.com/10042a2d53f1b8dc77a29b65c302e5a0.png](https://i.gyazo.com/10042a2d53f1b8dc77a29b65c302e5a0.png)


#Partie 1:

#Partie 2:

pour utiliser le puble veuiller update la config avec vos clef API dans (./bundle/config/packages/stripe.yaml) laisser le reste tel quel pour juste essayer le bundle.

le code du bundle se trouve dans le dossier .bundle/lib/Acme

si vous copier se code ailleur veuiller creer le fichier config inclure le bundle dans ./bundle/config/bundles.php de la maniere suivante: 
  Acme\StripeBundle\StripeBundle::class => ['all' => true],

et veuillez par ailleur ajouté l'autoload du namespace Acme vers lib/Acme et ajouté la definition des routes dans ./bundle/config/routes.yaml de la maniere suivante :
  stripe:
    resource: "@StripeBundle/Resources/config/routes.yaml"
 