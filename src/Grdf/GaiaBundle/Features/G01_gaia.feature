# language: fr
@G01 @GAIA 
Fonctionnalité: G01 - GAIA

Scénario: G01.1 - Non authentifié
    Soit je suis authentifié en tant que :
        | key                 | value  |
        | HTTP_SM_UNIVERSALID |        |
     
    Soit je suis sur la page d'accueil
    Alors je devrais voir "GAIA non détecté !"

Scénario: G01.2 - GAIA : normal
    Soit je suis authentifié en tant que :
        | key                 | value                   |
        | HTTP_SM_UNIVERSALID | BL4204                  |
        | HTTP_GAIA_PRENOM    | José                    |
        | HTTP_GAIA_NOM       | Ramos                   |
        | HTTP_GAIA_EMAIL     | jose.ramos@gmail.com    |
    
    Soit je suis sur la page d'accueil
    Alors je devrais voir "Applications"
    
    Soit je vais sur "/admin/application/"
    Alors je devrais voir "Vous n'avez pas les droits nécessaires !"
    
    Soit je vais sur "/admin/categorie/"
    Alors je devrais voir "Vous n'avez pas les droits nécessaires !"
    
    Soit je vais sur "/admin/metier/"
    Alors je devrais voir "Vous n'avez pas les droits nécessaires !"

Scénario: G01.3 - GAIA : admin
    Soit je suis authentifié en tant que :
        | key                 | value           |
        | HTTP_SM_UNIVERSALID | BX2076          |
        | HTTP_GAIA_PRENOM    | Michel          |
        | HTTP_GAIA_NOM       | Admin           |
        | HTTP_GAIA_EMAIL     | admin@gmail.com |
    
    Soit je suis sur la page d'accueil
    Alors je devrais voir "Applications"
    
    Soit je vais sur "/admin/application/"
    Alors je devrais voir "Applications" dans le titre de la page
    
    Soit je vais sur "/admin/categorie/"
    Alors je devrais voir "Thème" dans le titre de la page
    
    Soit je vais sur "/admin/metier/"
    Alors je devrais voir "Métiers" dans le titre de la page
