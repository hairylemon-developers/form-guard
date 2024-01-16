<?php

namespace HairylemonDevelopers\FormGuard;

use Illuminate\Support\Facades\Validator;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {

      $message = 'The :attribute field cannot contain URLs or email addresses.';

      Validator::extend('form_guard', function($attribute, $value, $parameters) {

        $pattern = '/(?:\b(?:https?|ftp):\/\/|www\.)[^\s<>\"]+|\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/u';
        if (preg_match_all($pattern, $value)) {
          return false;
        } else {
          return true;
        }

      }, $message);

    }
}
