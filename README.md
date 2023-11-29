# Projet-11-Geek-Ops-Back

# Installation :

# 1. Créez un fichier .env.local au même endroit que le .env et collez ceci :
  ` DATABASE_URL="mysql://explorateur:Ereul9Aeng@127.0.0.1:3306/geekops?serverVersion=10.3.38-MariaDB&charset=utf8mb4"`
   nom d'utilisateur/mot de passe / base de données geekops / et la version de MariaDB
    Pour permettre la connexion à la base de données, vous pouvez remplacer les valeurs. Par exemple, si vous créez un utilisateur avec tous les privilèges pour la base de données et un mot de passe.
# 2. Lancez la commande suivante dans le terminal du dossier : 
`composer update`
    Cela permet d'installer tous les composants Symfony nécessaires à l'utilisation.

# 3. Lancez les commandes suivantes dans le terminal du dossier :
   - `php bin/console d:d:c`   Cette commande exécute `doctrine database create`, qui crée la base de données du dossier .env.local, c'est-à-dire geekops.
   - `php bin/console d:m:m`   Exécute les migrations du dossier, c'est-à-dire les requêtes SQL qui vont remplir la base de données fraîchement créée .
   - `php bin/console d:f:l`   Permet de lancer les fixtures, c'est-à-dire les fausses données qui vont remplir cette magnifique base de données .

# 4. En bonne pratique, lancez le serveur :
  `php -S localhost:8080 -t public`  ensuite pour arriver sur la page rapidement petit racourci sympa faite ctrl et cliqué sur le (http:localhost:8080) !!  tada !! backoffice

# 5. En cas de problème avec la base de données :
   - Vérifiez que le nom correspond bien à votre identifiant Adminer.
   - Vérifiez le mot de passe.
   - Assurez-vous que le nom "geekops" dans la base de données n'existe pas. Si c'est le cas, exécutez la commande suivante :
     `php bin/console d:d:d --force`, puis reprenez l'étape 3.
   - Vérifiez que le fichier .env.local est bien au bon endroit.
  

