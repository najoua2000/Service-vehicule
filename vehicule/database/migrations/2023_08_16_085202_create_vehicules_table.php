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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->integer('autoecole_id');
            $table->string('img_carte_grise'); 
            $table->string('img_assurance'); 
            $table->string('img_visite_tech')->nullable();///
            $table->string('img_vignette');
            $table->string('modele');
            $table->integer('matricule')->unique(); 
            $table->string('fornisseur'); 
            $table->string('marque'); 
            $table->string('categorie_permis'); 
            $table->date('date_p_visete_technique'); 
            $table->date('date_vidange');
            $table->date('date_p_vidange'); 
            $table->date('date_assurance'); 
            $table->date('date_e_assurance'); 
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
