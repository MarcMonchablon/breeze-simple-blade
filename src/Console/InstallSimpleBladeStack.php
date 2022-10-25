<?php

namespace Laravel\Breeze\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallSimpleBladeStack
{
    // TODO

    /**
     * Install the Blade Breeze stack, without adding Tailwind to package.json.
     *
     * @return void
     */
    protected function installSimpleBladeStack()
    {
        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/simple-blade/app/Http/Controllers/Auth', app_path('Http/Controllers/Auth'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/simple-blade/app/Http/Requests/Auth', app_path('Http/Requests/Auth'));

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/simple-blade/resources/views/auth', resource_path('views/auth'));
        copy(__DIR__.'/../../stubs/simple-blade/resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));

        // Tests...
        $this->installTests();

        // Routes...
        copy(__DIR__.'/../../stubs/simple-blade/routes/web.php', base_path('routes/web.php'));
        copy(__DIR__.'/../../stubs/simple-blade/routes/auth.php', base_path('routes/auth.php'));

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));
        $this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        $this->line('');
        $this->components->info('Breeze scaffolding installed successfully.');
    }
}
