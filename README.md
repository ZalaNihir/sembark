Follow these sequential terminal commands step-by-step to deploy and configure the instance securely.

### 1. Clone the Repository
Clone the repository using Git and navigate to the project directory root:
```bash
git clone https://github.com
cd sembark
```

### 2. Install Composer Dependencies
Run the install command with optimization flags excluding development utilities:
```bash
composer install --no-dev --optimize-autoloader
```

### 3. Configure the Environment Values
Duplicate the example distribution settings template to instantiate your operational configurations:
```bash
cp .env.example .env
```

Now, open the newly created `.env` file using your text editor and accurately specify your  environment constraints, including app configurations and target relational database attributes:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=secure_password
```

### 4. Generate Application Encryption Key
Generate a secure, cryptographically sound application key to secure serialized session keys, cookie fingerprints, and encrypted parameters:
```bash
php artisan key:generate --force
```

### 5. Run Database Migrations
Execute your structural schema setup scripts against the target database connection:
```bash
php artisan migrate --seed
```

### 6. Install Node Dependencies & Build Assets
Compile the core JavaScript layouts, Tailwind utility layouts, and application styles via Vite:
```bash
npm install
npm run build
```

### 7. Optimize System Cache Assemblies
Cache the underlying framework engines to guarantee lightning-fast execution speed across all endpoints:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## File Permission Guidelines

To avoid runtime access control failures, ensure that the server's user account (e.g., `www-data` or `nginx`) owns the persistent caching and file storage structures:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## AI & Useage

* **GeminiCLI:** For updating the design
* **Codex:** For syntax checking & Url module error regarding `HasManyThrough` relationships & creating this MD file
