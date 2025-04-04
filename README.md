1 -> Dans le terminal taper pour creer la base de donnée: symfony console doctrine:database:create

2 -> composer require symfony/security symfony/twig-bundle symfony/orm-pack doctrine/annotations symfony/form symfony/validator symfony/maker-bundle symfony/asset symfony/webpack-encore-bundle

3 -> symfony console doctrine:migrations

4 -> symfony console doctrine:migrations:migrate

5 -> composer update