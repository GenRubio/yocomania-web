Instalamos las dependencias
php atisan composer install

Copiamos archivos .env
php artisan config:cache

Configuracion de  Livewire
php artisan vendor:publish --tag=jetstream-views
php artisan livewire:publish --assets
php artisan livewire:publish
abrir config / livewire.php cambiar 'asset_url' => nulla'asset_url' => 'https://yocobang.com/public