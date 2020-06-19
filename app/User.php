<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\Console\Descriptor\Descriptor;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    public $Description;
}
