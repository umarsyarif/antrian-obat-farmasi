<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function Migration()
    {
        Artisan::command('migrate', function () {
            $this->info("Migrated!");
        });
        return "Database Migrated!";
    }

    public function ServeWebsockets()
    {
        Artisan::command('websockets:serve', function () {
            $this->info("Websockets served!");
        });
        return "Websockets served!";
    }

    public function CleanWebsockets()
    {
        Artisan::command('websockets:clean', function () {
            $this->info("Websockets cleaned!");
        });
        return "Websockets cleaned!";
    }
}
