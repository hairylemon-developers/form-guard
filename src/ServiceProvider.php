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

        $pattern = '/(?:href=[\'"]?([^\'"\s>]+)[\'"]?)|#[-a-zA-Z0-9@:%_\+.~#?&\/\/=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?/siu';
        if (preg_match_all($pattern, $value)) {
          return false;
        } else {
          return true;
        }

      }, $message);

    }
}
