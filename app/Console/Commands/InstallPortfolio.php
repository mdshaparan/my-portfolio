<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallPortfolio extends Command
{
    protected $signature = 'portfolio:install';

    protected $description = 'Creates the database, runs migrations and seeds the default admin, menus and hero';

    public function handle(): int
    {
        $db   = config('database.connections.mysql.database');
        $conn = config('database.default');

        // With MySQL, create the database automatically if it does not exist
        if ($conn === 'mysql') {
            $this->info("Database check: {$db}");
            try {
                $host = config('database.connections.mysql.host');
                $port = config('database.connections.mysql.port');
                $pdo  = new \PDO(
                    "mysql:host={$host};port={$port}",
                    config('database.connections.mysql.username'),
                    config('database.connections.mysql.password')
                );
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$db}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            } catch (\Throwable $e) {
                $this->error('Could not connect to MySQL. Start MySQL in XAMPP and try again. Error: ' . $e->getMessage());
                return self::FAILURE;
            }
            DB::purge('mysql');
        }

        $this->info('Creating tables...');
        Artisan::call('migrate', ['--force' => true], $this->output);

        $this->info('Seeding default data...');
        Artisan::call('db:seed', ['--force' => true], $this->output);

        $this->newLine();
        $this->info('All set!');
        $this->line('Website : ' . config('app.url'));
        $this->line('Admin   : ' . rtrim(config('app.url'), '/') . '/shaparan-panel-7x9k');
        $this->line('Email   : admin@gmail.com');
        $this->line('Password: Admin@12345  (change it after your first login)');

        return self::SUCCESS;
    }
}
