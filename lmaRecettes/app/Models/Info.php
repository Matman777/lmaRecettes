<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'infosPages';
    protected $fillable = ['idUser', 'ip', 'user_agent', 'tag', 'param2', 'heure_connexion', 'heure_deconnexion'];
}
