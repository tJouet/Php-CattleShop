<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Types\AnimalType;

class AnimalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Inertia::share('providedAnimalTypes', function () {
            return collect(AnimalType::cases())->map(fn($type) => $type->value);
        });

        Inertia::share('providedAnimalFormInputs', function () {
            return [
                ['label' => 'Name', 'value' => 'name', 'type' => 'text'],
                ['label' => 'Type', 'value' => 'type', 'type' => 'select'],
                ['label' => 'Race', 'value' => 'race', 'type' => 'text'],
                ['label' => 'Age', 'value' => 'age', 'type' => 'number', 'min' => '1'],
                ['label' => 'Price', 'value' => 'price', 'type' => 'number', 'step' => '0.01', 'min' => '0'],
                ['label' => 'Description', 'value' => 'description', 'type' => 'text'],
                ['label' => 'Pictures', 'value' => 'images', 'type' => 'file', 'class' => 'file-input w-full max-w-xs'],
            ];
        });
    }
}
