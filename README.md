# MapSeed
## Cara install
1. run `composer install`
2. run `php artisan key:generate`
3. copy file `.env.example` menjadi file `.env`
4. buka file `.env` dan ubah bagian `DB_DATABASE` sesuai dengan nama database yang diinginkan
5. buat database dengan nama yang sama dengan `DB_DATABASE` jika belum dibuat
6. run `php artisan migrate:reset` lalu `php artisan migrate`
7. run `php artisan storage:link`
8. run `php artisan serve` lalu buka url yang muncul