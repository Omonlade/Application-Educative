# apiSymphony
Appllication mobile Kidsparklabs


*COMMANDE POUR HASHER UN MOT QUELCONQUE: -> php bin/console security:encode-password


# Creation du projet d'application web avec Api en symfony dont le nom est: 'dashboard-app-api'
1 -> symfony new dashboard-app-api --version="7.0.*" --webapp



2 -> Configurer le fichier: '.env': DATABASE_URL="mysql://jack:Gbado@127.0.0.1:3306/Kidsparklabs_db?serverVersion=8&charset=utf8mb4"
	/* 
		jack = Pour le nom d'utilisateur
		Gbado = Pour le mot de passe
		Kidsparklabs_db = pour le nom de la base de donnée.
	*/

3 -> Dans le terminal taper : symfony console doctrine:database:create

4 -> composer require symfony/security symfony/twig-bundle symfony/orm-pack doctrine/annotations symfony/form symfony/validator symfony/maker-bundle symfony/asset symfony/webpack-encore-bundle

5 -> symfony console doctrine:migrations:up

6 -> composer update

7 -> Dans le terminal taper : symfony console make:entity
		//-> INFORMATION A CE NIVEAU //-----------------------------------------------------------------------------
		                                                                                                            |
		<-> ON CREER D'ABORD LES TABLES QUI N'ONT PAS DE CLE SECONDAIRE D'ABORD                                     |
		<-> ON NE CREER PAS LES (ID), SYMFONY SE CHARGE DE SA                                                       |
		<-> ON CREER CHAQUE TABLE ET CES ATTRIBUTS. [APRES LE TOUT CREER. ON CREER LES JOINTURES ENTRE LES TABLES.] |
		-------------------------------------------------------------------------------------------------------------

 1963  symfony console make:entity
 1964  symfony console make:entity Eleve
 1965  symfony console make:entity
 1966  symfony console make:entity Tutoriels
 1967  symfony console make:entity Equipement	
 1968  symfony console make:entity Realiser
 1969  symfony console make:entity
 1970  symfony console make:entity Utilisation
 1971  symfony console make:entity
 1972  symfony console make:migration
 1973  symfony console doctrine:migration:migrate
 1974  symfony console make:user
 1975  symfony console make:entity
 1976  symfony console make:entity
 1977  symfony console make:migration
 1978  symfony console doctrine:migration:migrate

 1982  symfony console make:crud Projets
 1983  symfony console make:crud Visiteur
 1984  symfony console make:crud Eleve
 1985  symfony console make:crud Tutoriels
 1986  symfony console make:crud Equipement
 1987  symfony console make:crud Realise
 1988  symfony console make:crud Realiser
 1989  symfony console make:crud Utilisation
 1990  symfony console make:controller 
 1991  symfony console make:auth
 1992  composer require api
