# AirWorld

## Auteurs

- **Loïc GUEZO**
- **Bounmy PHANTHAVONG**

## Prérequis

Avant d'exécuter le projet, vous devez avoir installé les éléments suivants :

- **PHP** 
- **Composer**
- **SQLite** 

## Installation

1. **Cloner le projet** 
    
    depuis le dépôt Git :

   ```bash
   git clone https://lien_vers_le_dépôt.git
   cd nom_du_dossier
   ```
2.	**Installer les dépendances avec Composer** :

    Une fois dans le répertoire du projet, vous pouvez installer les dépendances avec Composer :

    ```bash
    composer install
    ```
3. **Exécuter les migrations** :

    Vous pouvez les exécuter avec la commande suivante pour ajouter les seeders :

    ```bash
    php artisan migrate --seed
    ```

    Si vous avez déjà exécuté les migrations, mais que vous rencontrez une erreur, vous pouvez réinitialiser la base de données et relancer les migrations et les seeders avec cette commande :

    ```bash
    php artisan db:wipe && php artisan migrate --seed
    ```

## Lancement
pour lancer l'executable, vous pouvez simplement faire 
```bash
    php artisan serve
```
Cela démarrera le serveur de développement Laravel à l’adresse http://localhost:8000.
