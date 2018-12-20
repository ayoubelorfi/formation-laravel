# Formation Laravel

## Installation et organisation

### Installation 

Pour installer le projet, nous avons 2 possibilités :

**Utiliser l'installer de Laravel** :

Utiliser **composer** pour installer globalement `laravel/installer` :
 
```
composer global require laravel/installer
```

Cependant, n'oubliez pas d'ajouter le dossier `$HOME/.config/composer/vendor/bin` dans le `$PATH`, dans votre profile `~/.profile` (pensez à faire un `source ~/.profile`).

Une fois votre installer et configurer, vous pouvez créer un nouveau projet avec la commande suivante :

```
laravel new blog
```

**En utilisant directement composer** :

```
composer create-project laravel/laravel blog
```

[Tutoriel vidéo d'installation](https://youtu.be/YpDqzb2IIms)

### Pré-requis PHP

* Version >= 5.5.9
* Extension PDO
* Extension Mbstring
* Extension OpenSSL
* Extension Tokenizer

### Organisation 

* `app` : Ce dossier contient les éléments essentiels de l'application
    * `Console` : toutes les commandes en mode console, il y a au départ une commande `Inspire` qui sert d'exemple
    * `Jobs` : commandes concernant les tâches que doit effectuer l'application. C'est une nouveauté de la version 5 que je n'aborderai pas dans ce cours
    * `Events` & `Listeners` : événements et écouteurs nécessaires pour l'application
    * `Http` : tout ce qui concerne la communication : contrôleurs, routes, middlewares (il y a quater middlewares de base) et requêtes
    * `Providers` : tous les fournisseurs de services (providers), il y en a déjà 4 au départ. Les providers servent à initialiser les composants
    * `Policies` : une évolution récente qui permet de gérer facilement les droits d'accès    
    * `User.php` : On trouve également le fichier User.php qui est un modèle qui concerne les utilisateurs pour la base de données    
* `bootstrap` : scripts d'initialisation de Laravel pour le chargement automatique des classes, la fixation de l'environnement et des chemins, et pour le démarrage de l'application
* `public` : tout ce qui doit apparaître dans le dossier public du site : images, CSS, scripts...
* `vendor` : tous les composants de Laravel et de ses dépendances
* `config` : toutes les configurations : application, authentification, cache, base de données, espaces de noms, emails, systèmes de fichier, session...
* `database` : migrations et les populations
* `resources` : vues, fichiers de langage et assets (par exemple les fichiers LESS ou Sass)
* `storage` : données temporaires de l'application : vues compilées, caches, clés de session...
* `tests` : fichiers de tests unitaires    
* `artisan` : outil en ligne de Laravel pour des tâches de gestion
* `composer.json` : fichier de référence de Composer
* `phpunit.xml` : fichier de configuration de phpunit (pour les tests unitaires)
* `.env` : fichier pour spécifier l'environnement d'exécution           

[Tutoriel vidéo - Structure de base d'une application Laravel](https://youtu.be/igkr7EN9QuM)

### Installation de composant Laravel

Pour mettre en pratique l'installation de composant Laravel, nous allons installer le composant relatif à la création de formulaire, qui propose un certain nombre d'helpers :

```
composer require laravelcollective/html 5.7.*
```

Mettons à jour notre configuration dans `config/app.php` :

```php
<?php
 
return [
    // ...        
    'providers' => [
        // ...
        Collective\Html\HtmlServiceProvider::class,
    ],        
    // ...
    'aliases' => [
        // ...
        'Form'  => Collective\Html\FormFacade::class,
        'Html'  => Collective\Html\HtmlFacade::class,
    ]
    // ...
];
```

### En résumé

* Pour son installation et sa mise à jour Laravel utilise le gestionnaire de dépendances `Composer`.
* La création d'une application Laravel se fait à partir de la console avec une simple ligne de commande.
* Laravel est organisé en plusieurs dossiers.
* Le dossier `public` est le seul qui doit être accessible pour le client.
* L'environnement est fixé à l'aide du fichier `.env`.
* Le composant `Html` n'est pas prévu par défaut, il faut le charger indépendamment.

## Le routage et les façades

### Le cycle d'ue requête

Lorsque la requête atteint le fichier `public/index.php` l'application Laravel est créée et configurée et l'environnement est détecté. Nous reviendrons plus tard plus en détail sur ces étapes. Ensuite le fichier `routes/web.php` est chargé. 

C'est avec ce fichier que la requête va être analysée et dirigée. Regardons ce qu'on y trouve au départ :

```php
<?php

Route::get('/', function () {
    return view('welcome');
});
```

Comme Laravel est explicite vous pouvez déjà deviner à quoi sert ce code :
* `Route` : on utilise le routeur,
* `get` : on regarde si la requête a la méthode "get",
* `'/'` : on regarde si l'url comporte uniquement le nom de domaine, dans la fonction anonyme on retourne (`return`) une vue (`view`) à partir du fichier "welcome".

Autre exemple avec un paramètre variable :
```php
<?php 

Route::get('{n}', function($n) {
	return 'Je suis la page ' . $n . ' !'; 
});
```

Et un dernier exemple avec un **route nommée** :
```php
<?php

Route::get('/route-nommee', ["as" => "route_nommee",  function(){
    return "route nommée";
}]);
```

### Façades

Laravel propose de nombreuses façades pour simplifier la syntaxe. Vous pouvez les trouver toutes déclarées dans le fichier `config/app.php` :
```php
<?php

return [
    // ...
    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
    ],
];
```

### En résumé

* Laravel possède un fichier `public/.htaccess` pour simplifier l'écriture des url.
* Le système de routage est simple et explicite.
* On peut prévoir des paramètres dans les routes.
* On peut contraindre un paramètre à correspondre à une expression régulière.
* On peut nommer une route pour faciliter la génération des URL et les redirections.
* Il faut prévoir de gérer toutes les url, même celles qui n'ont aucune route prévue.
* Laravel est équipé de nombreuses façades qui simplifient la syntaxe.
* Il existe aussi des helpers pour simplifier la syntaxe. 

## Les réponses

### Construire une réponse

Dans les exemples que j'ai utilisés dans le chapitre précédent sur les routes, je n'ai pas précisé de code. Je me suis contenté de retourner un texte au client. Celui-ci n'a aucune utilité du code et veut quelque chose d'explicite, par contre les moteurs de recherche savent interpréter ces codes.

En plus du simple `return` pour renvoyer la réponse je peux utiliser l'helper `response` et préciser le code :
```php
<?php

Route::get('/{n}', function($n) {
    return response('Je suis la page ' . $n . ' !', 200);
})->where('n', '[0-9]+');
```

Voici son équivalent avec une façade :
```php
<?php

Route::get('/{n}', function($n) {
    return Response::make('Je suis la page ' . $n . ' !', 200);
})->where('n', '[0-9]+');
```

### Les vues

Il faut enregistrer cette vue (j'ai choisi le nom "vue1") dans le dossier `resources/views` avec l'extension `php`.

On peut appeler cette vue à partir d'une route avec ce code :
```php
<?php

Route::get('/hello', function(){
    return view('hello');
});
```

### Vue paramétrée

Passons maintenant des paramètres à notre vue :
```php
<?php

Route::get('/bonjour-{prenom}', function($prenom){
    return view('bonjour')->with('numero', $prenom);
})->where('prenom', '[a-zA-Z]+');
```

Voici d'autres manières d'ajouter des paramétres à notre vue :
```php
<?php

Route::get('/bonjour-{prenom}', function($prenom){
    return view('bonjour')->withPrenom($prenom);
})->where('prenom', '[a-zA-Z]+');
```

```php
<?php

Route::get('/bonjour-{prenom}', function($prenom){
    return view('bonjour', ["prenom" => $prenom]);
})->where('prenom', '[a-zA-Z]+');
```

### Blade

Laravel possède un moteur de template élégant nommé Blade qui nous permet de faire pas mal de choses. La première est de nous simplifier la syntaxe. Par exemple au lieu de la ligne suivante que nous avons prévue dans la vue précédente :

Avec notre exemple précédent :
```blade
<!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ma première vue</title>
    </head>
    <body>
        Bonjour <?php echo $prenom; ?> en php<br/>
        Et avec Blade : Bonjour {{ $prenom }}
    </body>
</html>
```

Passons maintenant au template :
```blade
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('titre')</title>
    </head>
    <body>
        @yield('body')
    </body>
</html>
```

Notre vue héritant de ce template : 
```blade
@extends('base')

@section('body')
    Hello world !
@endsection
```

### En résumé

* Laravel offre la possibilité de créer des vues.
* Il est possible de transmettre simplement des paramètres aux vues.
* L'outil Blade permet de créer des templates et d'optimiser ainsi le code des vues.
* On peut facilement effectuer des redirections.

## Contrôleurs

Nous avons vu le cycle d'une requête depuis son arrivée, son traitement par les routes et sa réponse avec des vues qui peuvent être boostées par Blade. Avec tous ces éléments vous pourriez très bien réaliser un site web complet mais Laravel offre encore bien des outils performants que je vais vous présenter.

Pour bien organiser son code dans une application Laravel il faut bien répartir les tâches. Dans les exemples vus jusqu'à présent j'ai renvoyé une vue à partir d'une route, vous ne ferez jamais cela dans une application réelle (même si personne ne vous empêchera de le faire ! ). Les routes sont juste un système d'aiguillage pour trier les requêtes qui arrivent. Mais alors qui s'occupe de la suite ? Et bien ce sont les contrôleurs, le sujet de ce chapitre

Pour créer un contrôleur nous allons utiliser Artisan, la boîte à outils de Laravel. Dans la console entrez cette commande :
```
php artisan make:controller PostController
```

Un nouveau fichier vient d'être généré `àpp/Http/Controllers/PostController.php`.

Nous ajoutant une nouvelle action :
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        return view('post/list');
    }
}
```

Passons à la configuration de la route :
```php
<?php

Route::get('/blog', ["uses" => 'BlogController@list', "as" => "blog_list"]);
```

**Atelier pratique : Créer nos routes pour le CRUD des posts.**

### En résumé

* Les contrôleurs servent à réceptionner les requêtes triées par les routes et à fournir une réponse au client.
* Artisan permet de créer facilement un contrôleur.
* Il est facile d'appeler une méthode de contrôleur à partir d'une route.
* On peut nommer une route qui pointe vers une méthode de contrôleur.

## Les entrées

Dans bien des circonstances, le client envoie des informations au serveur. La situation la plus générale est celle d'un formulaire. Nous allons voir dans ce chapitre comment créer facilement un formulaire avec Laravel, comment réceptionner les entrées et nous améliorerons notre compréhension du routage. 

### Scénario et routes

Nous allons envisager un petit scénario avec une demande de formulaire de la part du client, sa soumission et son traitement :
* *Client -> Serveur* : Demande l'affichage du formulaire
* *Serveur -> Client* : Affichage le formulaire
* *Client -> Serveur* : Soumission son formulaire

On va donc avoir besoin de deux routes :
* une pour la demande du formulaire avec une méthode "get"
* une pour la soumission du formulaire avec une méthode "post"

On va donc créer ces deux routes :

```php
<?php

Route::get('test-get', ["as" => "test_get", function() {
     return view("test_get");
}]);

Route::post('test-post', ["as" => "test_post", function() {
   return response('Requête POST', 200);
}]);
```

Si une route gère tout à la fois :

```php
<?php

Route::any('test-any', function() {
   return response('Requête ALL', 200);
});
```

Qu'est ce que cela donne avec notre scénario :
* *Client -> Serveur* : Demande l'affichage du formulaire => **Méthode GET**
* *Serveur -> Client* : Affichage le formulaire
* *Client -> Serveur* : Soumission son formulaire => **Méthode POST**

### Les middlewares

Je parlerai plus en détail des middlewares plus tard. Pour le moment on va se contenter de savoir que c'est du code qui est activé à l'arrivée de la requête (ou à son départ) pour effectuer un traitement. C'est pratique pour arrêter par exemple directement la requête s'il y a un problème de sécurité.

Laravel peut servir comme application "web" ou comme "api". Dans le premier cas on a besoin :
* de gérer les cookies,
* de gérer une session,
* de gérer la protection CSRF (dont je parle plus loin dans ce chapitre).

Je vous invite à regarder le fichier `app/Http/Kernel.php` :
```php
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    //...

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        // ...
    ];
    
    //...
}

```

### Les formulaires

Voyons ensemble pour créer notre premier formulaire (on reprends l'exemple avec la route `test_get` et `test_post`) :
```blade
@extends('base')

@section('body')
    {!! Form::open(['url' => 'test-post']) !!}
        {!! Form::label('name', 'Entrez votre nom : ') !!}
        {!! Form::text('name') !!}
        {!! Form::submit('Envoyer !') !!}
    {!! Form::close() !!}
@endsection
```

Passons au traitement de notre formulaire :
```php
<?php

// ...

Route::post('test-post', ["as" => "test_post", function(Request $request) {
    return response($request->post("name"), 200);
}]);
```

**Atelier pratique : Créer le formulaire d'ajout d'un article.**

## En résumé

* Laravel permet de créer des routes avec différents verbes : get, post...
* Un formulaire peut facilement être créé avec la classe Form.
* Les entrées du client sont récupérées dans la requête.﻿﻿
* On peut se prémunir contre les attaques CSRF, cette défense est mise en place automatiquement par Laravel﻿﻿.

## La validation

Maintenant que nous avons créé notre premier formulaire, il faut pouvoir valider les données saisies. Pour cette exemple nous allons créer un formulaire de contact.

Mais avant ça, petit tour d'horizon sur l'ajout de fichiers css et javascripts dans notre template `base` :

```blade
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('titre')</title>
        
		{!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') !!}
    </head>
    <body>
        @yield('body')
        {!! Html::script('https://code.jquery.com/jquery-3.3.1.slim.min.js') !!}
		{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') !!}
		{!! Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') !!}
    </body>
</html>
```

Maintenant que nous avons inclut **bootstrap**, concevons notre formulaire :
```blade
@extends('base')

@section('body')
    <div class="container">    
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Contactez-moi</div>
                    <div class="panel-body"> 
                        {!! Form::open(['url' => 'contact']) !!}
                            <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                                {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
                                {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                            </div>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Votre email']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                            <div class="form-group {!! $errors->has('texte') ? 'has-error' : '' !!}">
                                {!! Form::textarea ('texte', null, ['class' => 'form-control', 'placeholder' => 'Votre message']) !!}
                                {!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
                            </div>
                            {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
```

Passons à la configuration des routes :

```php
<?php

Route::get('contact', ["as" => "contact", function() {
     return view("contact");
}]);

Route::post('send', ["as" => "send", function(Request $request) {
   return view("send", $request->post());
}]);
```

Seulement il existe un moyen notre requête du formulaire plus simplement.

### La requête du formulaire

On va générer un service qui nous permettra de gérer notre requête récupérer après soumission du formulaire.

Utilisons **artisan** pour générer notre `Request` :
```
php artisan make:request ContactRequest
```

Un fichier vient d'être généré `app/Http/Requests/ContactRequest.php` :
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```

La classe générée comporte 2 méthodes :
* **authorize** : pour effectuer un contrôle de sécurité éventuel sur l'identité ou les droits de l'émetteur,
* **rules** : pour les règles de validation.

Ajoutons des règles de validation :
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		return [
			'nom' => 'required|min:5|max:20|alpha',
			'email' => 'required|email',
			'texte' => 'required|max:250'
		];
    }
}
```

Au niveau de la méthode `rules` on retourne un tableau qui contient des clés qui correspondent aux champs du formulaire. Vous retrouvez le nom, l'email et le texte. Les valeurs contiennent les règles de validation. Comme il y en a chaque fois plusieurs elles sont séparées par le signe "|". Voyons les différentes règles prévues :
* **required** : une valeur est requise, donc le champ ne doit pas être vide,
* **min** : nombre minimum de caractères, par exemple `min:5` signifie "au minimum 5 caractères",
* **max** : c'est l'inverse de "min" avec un nombre maximum de caractères,
* **alpha** : on n'accepte que les caractères alphabétiques,
* **email** : la valeur doit être une adresse email valide.

Passons au traitement et validation du formulaire :
```php
<?php

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;

Route::post('send', ["as" => "send", function(ContactRequest $request) {
    Mail::to('tboileau.info@gmail.com')->send(new ContactMail($request->all()));
    return view("send", $request->all());
}]);
```

### En résumé

* La validation est une étape essentielle de vérification des entrées du client.
* On dispose de nombreuses règles de validation.
* Le validateur génère des erreurs explicites à afficher au client.
* Pour avoir les textes des erreurs en Français il faut aller chercher les traductions et les placer dans le bon dossier.
* Laravel permet l'envoi simple d'email.

## Base de données

### Migration

Une migration permet de créer et de mettre à jour un schéma de base de données. Autrement dit, vous pouvez créer des tables, des colonnes dans ces tables, en supprimer, créer des index... Tout ce qui concerne la maintenance de vos tables peut être pris en charge par cet outil.

Commençons par installer la migration :
```
php artisan migrate:install
```

Avec ce système de migration, nous allons pouvoir créer notre table `post` :
```
php artisan make:migration create_post_table
```

Dans le fichier `database/migrations/XXXX_XX_XX_XXXXXX_create_post_table.php` :
```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 255);
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
```

Il ne nous reste plus qu'à migrer :

```
php artisan migrate
```

**Atelier pratique : Créer la table `comment`.**

### Eloquent

Laravel propose un ORM (acronyme de object-relational mapping ou en bon Français un mappage objet-relationnel) très performant. De quoi s'agit-il ? Tout simplement que tous les éléments de la base de données ont une représentation sous forme d'objets manipulables. Quel intérêt ? Tout simplement de simplifier grandement les opérations sur la base comme nous allons le voir dans toute cette partie du cours.

Générons notre premier modèle :
```
php artisan make:model Post
```

**Atelier pratique : Créer le modèle `Comment`.**

Maintenant que nous avons créé notre modèle `Post`, prenons tout de suite le refléxe de générer notre `PostRequest`, qui nous servira pour la validation.

```
php artisan make:request PostRequest
```

**Atelier pratique : Modifier `PostRequest` pour ajouter des règles de validation.**

Plus tôt, nous avons créé les routes pour la gestion de notre blog. Il va falloir l'adapter pour avoir une structure plus propre.

* app
    * Http
        * Controllers
            * Post
                * ListController.php
                * ShowController.php
                * AddController.php
                * UpdateController.php
                * DeleteController.php
                
Générons ensemble le premier contrôleur :
```
php artisan make:controller Post/ListController
```

**Atelier pratique : Créer les autres contrôleurs et modifier les routes.**

### Afficher la liste des articles

Nous allons créer la page de listing des articles, commençons par le contrôleur :
```php
<?php

namespace App\Http\Controllers\Post;

use App\Post;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function get()
    {
        $posts = Post::all();

        return view("post/list", ["posts" => $posts]);
    }
}
```

Et maintenant la vue :
```blade
@extends('base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route("post_show", ["id" => $post->id]) }}" class="btn btn-sm btn-primary mx-2">Voir</a>
                                    <a href="{{ route("post_update_get", ["id" => $post->id]) }}" class="btn btn-sm btn-primary mx-2">Modifier</a>
                                    <a href="{{ route("post_delete", ["id" => $post->id]) }}" class="btn btn-sm btn-primary mx-2">Supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
```

### Insérer en base de données

Passons maintenant à la vue et au traitement de notre formulaire pour la page d'ajout :
```php
<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{
    public function get()
    {
        return view("post/add");
    }

    public function post(PostRequest $postRequest)
    {
        $post = new Post();
        $post->title = $postRequest->input("title");
        $post->content = $postRequest->input("content");
        $post->save();


        return redirect()->route('post_list');
    }
}

```

**Atelier pratique : Finir le CRUD.**
