# Mon guide complet

Ceci est la première API Laravel que je créé dans l'optique de la consommer dans mon App ReactJs.  
Il me servira de guide pour bien comprendre ce que je fais ici.

### Création de mon modèle de Post

```
php artisan make:model Post -m
```

**-m** me permet de spécifier laravel que je veux qu'il me créé des migrations

Si j'obtiens un message d'erreur au moment de la création de la migration, je dois apporter les modifications  
suivantes dans le fichier appservicesprovider :

```
// je modifie la taille du schema
Schema::defaultStringLength(191);

```

### Le dossier routes > api.php

C'est ce fchier qui contient toutes les routes pour consommer mon API

```
// récupérer tous les articles
Route::get('test', function () {
    return 'Bienvenue sur mon App';
});

```

### les controllers

j'exécute la commande :

```
php artisan make:controller Api\PostController

```

Automatiquement il créé un sous dossier Api dans http>Controller. Mes fichiers controlleurs se trouverons à l'intérieur

### Les Request

Laravel a mis en place des mecanismes comme les request pour nous simplifier la vie de codeur
Mon request qui me permet de créer un post:

```
php artisan make:request CreatePostRequest

```

Mes requests personnalisées se trouvent dans Http>Requests
