# Rcar

Site de location de voiture avec systeme d'authentification / Inscription 
(confirmation d'email), un formulaire d'annonce, l'utilisateur peut modifier son annonce, Admin peut gérer les différentes annonces (CRUD)

	- Systeme authentification / Inscription avec confirmation d'email
	- Admin
	- Client 
	- Envoie d'email
	- Back Office pour utilisateur et admin
	- Formulaire d'annonce 
	- Barre de Recherche
	- tchat? bundle 
	
Utilisation du bundle AliceBundle pour créer du faux contenu.

### Fonctionnalités :

Non connecté : 

    - Possibilité de consulter les annonces de location
    - Possibilité de faire une Recherhce
    - Inscription avec confirmation (email)
    
Connecté :

    - Consulter les annonces de location
    - Mettre une voiture en location avec :
        - nom
        - prix
        - image
        - ville
        - couleur
        - type de carburant 
        - mots clés
    - Possibilité de faire une Recherhce
    - Accès à "Mes annonces" (liste d'annonces postées par l'user conecté)
    - Possibilité de modifier / supprimer les annonces (de l'user connecté)   
    
Admin :

    - Consulter les annonces de location
    - Mettre une voiture en location
    - Accès à "Mes annonces" (liste d'annonces postées par l'user conecté)
    - Possibilité de modifier / supprimer les annonces (TOUTES les annonces) 
    - Accès à "Liste des utilisateurs" (tous les user inscrit)