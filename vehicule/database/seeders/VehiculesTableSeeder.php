<?php

namespace Database\Seeders;

use App\Models\Vehicule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiculesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicule::create([
            'autoecole_id' => 2,
            'img_carte_grise' => 'chemin/vers/image1.jpg',
            'img_assurance' => 'chemin/vers/image2.jpg',
            'img_vignette' => 'chemin/vers/image3.jpg',
            'img_visite_tech' => 'chemin/vers/image4.jpg',
            'modele' => 'Modèle 1',
            'matricule' => 123418,
            'fornisseur' => 'Fournisseur 1',
            'marque' => 'Marque 1',
            'categorie_permis' => 'A',
            'date_p_visete_technique' => '2023-08-01',
            'date_vidange' => '2023-08-10',
            'date_p_vidange' => '2023-08-15',
            'date_assurance' => '2023-09-01',
            'date_e_assurance' => '2024-09-01',
        ]);
        
    }
}
