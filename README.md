Prerequis : PHP 7 est plus

1- git clone https://bitbucket.esti.mg/scm/obroljpf/laravel-vuejs-alert.git

2 - Lancer le serveur web MysQl(wamp, xammp. lamp, ...)

3- Creer une base de donnees nommee "siteweb"

4- Faire "composer install"

5 - "composer require laravel/passport" puis => php artisan passport:install

6- Installer les dependances "npm install"

7- npm run dev: si erreur de compilation

	Executer :
		-> npm update vue
		-> npm update vue-froala-wysiwyg
		-> npm install --save babel-runtime @babel/runtime-corejs2

	refaire => npm run dev

	si reussie : etape suivant.


8- Faire "php artisan migrate"

9- Faire "php artisan serve" puis aller a => localhost:3000
