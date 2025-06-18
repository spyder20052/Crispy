# BurgerDash - Guide de démarrage

Ce guide explique comment installer et lancer le projet BurgerDash après un `git pull`.

## Prérequis
- PHP >= 8.1
- Composer
- Node.js >= 18 et npm
- MySQL ou autre base de données compatible

## Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-repo>
   cd burgerdash
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Copier le fichier d'environnement**
   ```bash
   cp .env.example .env
   ```

5. **Générer la clé d'application**
   ```bash
   php artisan key:generate
   ```

6. **Configurer la base de données**
   - Ouvre `.env` et configure les variables `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` selon ta configuration locale.

7. **Lancer les migrations (et seeders si besoin)**
   ```bash
   php artisan migrate --seed
   ```

8. **Lancer le serveur de développement Vite**
   ```bash
   npm run dev
   ```

9. **Lancer le serveur Laravel**
   ```bash
   php artisan serve
   ```

10. **Accéder à l'application**
    - Ouvre [http://localhost:8000](http://localhost:8000) dans ton navigateur.
    - **Important :** Utilise bien `localhost` (et pas `127.0.0.1`) pour que les styles s'affichent correctement avec Vite.

## Problèmes fréquents
- Si les styles ne s'affichent pas, vérifie que tu utilises bien `localhost:8000` et que `npm run dev` tourne.
- Si tu modifies `.env`, relance les serveurs.
- Pour toute erreur, vérifie la console du navigateur et les logs Laravel (`storage/logs/`).

## Commandes utiles
- `php artisan migrate:fresh --seed` : Réinitialise la base de données.
- `npm run build` : Build des assets pour la production.

---

Pour toute question, contacte l'équipe technique.
