<?php

namespace App\Providers;

use App\Models\News;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,
        News::class => NewsPolicy::class,
    ];
}
