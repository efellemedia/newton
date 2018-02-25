# Newton
A simple starter Laravel base for our internal tools and projects. Open-sourced in the spirit of [Spatie's Blender](https://github.com/spatie/blender) project.

## Getting Started

### Installing Newton

##### 1. Clone Repository
```bash
git clone https://github.com/efellemedia/newton.git
```

##### 2. Install Composer Dependencies
```bash
composer install
```

##### 3. Copy `.env.example`
```bash
cp .env.example .env
```

##### 4. Generate Key
```bash
php artisan key:generate
```

### Installing Assets
Newton utilizes yarn for frontend asset management. Laravel Mix is then used for compilation.

##### 1. Install Dependencies
```bash
yarn
```

##### 2. Watch Assets for Changes
```bash
yarn watch
```
