<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('infosPages', function (Blueprint $table) {
            $table->string('idUser')->nullable();
            $table->id();
            $table->string('ip');
            $table->string('user_agent');
            $table->timestamp('heure_connexion');
            $table->timestamp('heure_deconnexion')->nullable();
            $table->string('tag')->nullable();
            $table->string('param2')->nullable();
            //$table->integer('nombre_personnes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
