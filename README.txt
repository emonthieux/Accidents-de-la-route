Le but de ce projet est de faire une synthèse des accidents de la route avec les données disponibles en suivant ce lien :
https://www.data.gouv.fr/fr/datasets/base-de-donnees-accidents-corporels-de-la-circulation/

Hormis l'utilisation d'un site web, aucune contrainte n'a été imposée.
Nous avons donc cherché les axes d'analyse les plus pertinents et la manière la plus intéressante de les afficher.

Le point principal à améliorer est la lenteur du chargement des pages. Celà est dû au fait que nous n'avons pas créer de vues.
Nous devons donc effectuer une opération pour lier les tables à chaque chargement de graphique.

Aussi, nous en avons profité pour ajouter un système permettant d'insérer chaque nouvel accident.
Cependant il n'est pas pleinement opérationnel et ne fonctionne que dans le cas où un seul véhicule et un seul usager sont impliqués.
