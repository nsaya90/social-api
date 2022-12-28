# social

## Création d'une API réseau social 

- Ajout d'un utilisateur / Modification du profil
- Ajout de publication / commentaire / like
- Traitement des informations en base de donnée

- Mise en place des models / controller / migration
- Route API

- Front : https://github.com/nsaya90/social-front
- Framework : Laravel



## Project setup
```
php artisan key:generate
```

### Créer une base de donnée vide et migrer les models sur cette nouvelle base de donnée
```
Modifier le .env -> renommer la database pour faire la correspondance
php artisan migrate
```

### Lancer l'API
```
php artisan serve
```


