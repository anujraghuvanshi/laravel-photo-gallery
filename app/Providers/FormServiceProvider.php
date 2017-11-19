<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Form::component('text', 'component.form.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component('textarea', 'component.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        Form::component('submit', 'component.form.submit', ['value' => 'submit', 'attributes' => []]);
        Form::component('hidden', 'component.form.hidden', ['name', 'value' => null, 'attributes' => []]);
        Form::component('file', 'component.form.file', ['name', 'attributes' => []]);
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
