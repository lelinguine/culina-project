# projet-valentin-kadir/Culina

This project uses Laravel, Vue.js, and ShadCN, with optimized configuration using Vite.

- Laravel: Powerful PHP framework for the backend.
- Vue.js: Reactive JavaScript framework for building dynamic user interfaces.
- ShadCN: UI component library for Vue.js with simplified Tailwind variant management.
- Vite: Rapid development tool for a modern workflow with ultra-fast compilation.

To start the project, follow the installation steps from "Install" to "Start".

# 💿 - Install

### Environment
Create the environment file.
```bash
cp .env.example .env
```

<!-- ## Optional

### ⚠️ sign with Google
Setup Google api in Google Console and in .env file.<br><br>
GOOGLE_CLIENT_ID=''<br>
GOOGLE_CLIENT_SECRET=''<br>
GOOGLE_REDIRECT_URI=''<br><br>
https://console.cloud.google.com/welcome/<br> -->

### Dependencies
Install with npm for Nodejs.
```bash
npm install
```
And with composer for Laravel.
```bash
composer install
```

### Key
Generate a unique and secure application key.
```bash
php artisan key:generate
```

<!-- ## Optional

### ⚠️ php.ini
You may encounter php configuration errors.<br><br>
extension=pdo_sqlite<br>
extension=sqlite3<br>
extension=fileinfo<br><br> -->

# 🔎 - Datas

### Database
Generate the database.sqlite file.<br>
**Linux / MacOS**
```bash
touch database/database.sqlite
```
or **Windows (CMD)**  
```bash
echo. > database\database.sqlite
```
or **Windows (PowerShell)**
```bash
New-Item -Path "database\database.sqlite" -ItemType File
```

### Migration
Create the tables described in the migrations.
```bash
php artisan migrate
```

### Insert
Insert the data described in the Seeders/Factories.
```bash
php artisan db:seed
```

### Link
Create a symlink to link storage to public. Useful for medias.
```bash
php artisan storage:link
```

# 💡 - Start
### Run
Run VueJS.
```bash
npm run dev
```
And Laravel.
```bash
php artisan serve
```
After that, open `http://localhost:8000` in your browser.

That's it!

# 🔧 - Tools

### Shadcn-vue
Add new shadcn-vue components.
```bash
npx shadcn-vue@latest add <component>
```
https://www.shadcn-vue.com/docs/introduction.html<br>
https://lucide.dev/icons/<br>


# 📄 - Documentation
### Features
Consultez la [documentation](docs/features.md) pour plus de détails sur les fonctionnalités disponibles.

### Endpoints
Consultez la [documentation](docs/endpoints.md) pour plus de détails sur les routes disponibles.

# 🔗 - Sources
https://vueschool.io/articles/vuejs-tutorials/the-ultimate-guide-for-using-vue-js-with-laravel/<br>
