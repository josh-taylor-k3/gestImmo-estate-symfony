1) create a .env.local file, then copy .env content and past it in .env.local. Set your database, mailer login infos and developers.facebook acces
2) run composer install
3) run yarn install
4) run bin/console d:d:c
5) run bin/console doctrine:make:migration
6) run yarn encore production
7) set your facebook OAUTH id and facebook OAUTH secret in .env.local
8) active HTTPS (https://www.youtube.com/watch?v=1daMCJeh5yM if you're in localhost), https://doc.ubuntu-fr.org/tutoriel/securiser_apache2_avec_ssl if you've got a server
9) follow this documentation (https://developers.facebook.com/docs/facebook-login/security#strict_mode) to configure your app on facebook
10) enjoy !
