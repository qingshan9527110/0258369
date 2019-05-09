<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29 0029
 * Time: 18:20
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admins extends Model
{
    use Notifiable;

    protected $fillable = [
        'account',
        'name',
        'phone',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
