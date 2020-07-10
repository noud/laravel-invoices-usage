<?php

namespace InvoicesUsage\Providers;

use Illuminate\Support\ServiceProvider;

class InvoicesUsageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
