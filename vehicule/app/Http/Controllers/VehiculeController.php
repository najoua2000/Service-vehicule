<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicule;
use ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{

//Ajouter un vehicule
    public function store(Request $request)
        {
        try{
                $userAutoecoleId = $request->session()->get('user_autoecole_id');
                $request->merge(['autoecole_id' => $userAutoecoleId]);
                $validatedData =Validator::make($request->all(), [
                    'autoecole_id'=>'required|integer',
                    'img_carte_grise' => 'required|string',
                    'img_assurance' => 'required|string',
                    'img_vignette' => 'required|string',
                    'img_visite_tech' => 'nullable|string',//yyyyyyyyyyy
                    'modele' => 'required|string',
                    'matricule' => 'required|integer|unique:vehicules',
                    'fornisseur' => 'required|string',
                    'marque' => 'required|string',
                    'categorie_permis' => 'required|in:A,A1,AM,B,C,D,EB,EC,ED,F,FC',
                    'date_p_visete_technique' => 'required|date',
                    'date_vidange' => 'required|date',
                    'date_p_vidange' => 'required|date',
                    'date_assurance' => 'required|date',
                    'date_e_assurance' => 'required|date',
                
                ]);
                if ($validatedData->fails()) {
                    return response()->json(['errors' => $validatedData->errors()], 422);
                }
                
                $vehicule = new Vehicule();
                $vehicule->img_carte_grise = $validatedData->validated()['img_carte_grise'];
                $vehicule->img_assurance = $validatedData->validated()['img_assurance'];
                $vehicule->img_visite_tech = $validatedData->validated()['img_visite_tech'];
                $vehicule->img_vignette = $validatedData->validated()['img_vignette'];
                $vehicule->modele = $validatedData->validated()['modele'];
                $vehicule->autoecole_id = $validatedData->validated()['autoecole_id'];
                $vehicule->matricule = $validatedData->validated()['matricule'];
                $vehicule->fornisseur = $validatedData->validated()['fornisseur'];
                $vehicule->marque = $validatedData->validated()['marque'];
                $vehicule->categorie_permis = $validatedData->validated()['categorie_permis'];
                $vehicule->date_p_visete_technique = $validatedData->validated()['date_p_visete_technique'];
                $vehicule->date_vidange = $validatedData->validated()['date_vidange'];
                $vehicule->date_e_assurance = $validatedData->validated()['date_e_assurance'];
                $vehicule->date_p_vidange = $validatedData->validated()['date_p_vidange'];
                $vehicule->date_assurance = $validatedData->validated()['date_assurance'];  
                $vehicule->save();    
                        return response()->json(['message' => 'Véhicule créé avec succès', 'vehicule' => $vehicule], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
            }

        }
//Afficher par id
public function show(Request $request)
{
    try {
        $userAutoecoleId = $request->session()->get('user_autoecole_id');
        $request->merge(['autoecole_id' => $userAutoecoleId]);
       $vehicule = Vehicule::where('id', $request->id)
             ->where('autoecole_id', $request->autoecole_id)
             ->firstOrFail();
        return response()->json(['vehicule' => $vehicule]);
    } catch (\ModelNotFoundException $exception) {
        return response()->json(['message' => 'Véhicule non trouvé'], 404);
    }
    catch (\Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
}
//Afficher par liste
    public function showListe(Request $request)
        {
            try {
                $vehicules = Vehicule::whereIn('id',  $request->id)
                ->where('autoecole_id', $request->autoecole_id)
                ->get();
               
                return response()->json(['vehicule' => $vehicule]);
            } catch (\ModelNotFoundException $exception) {
                return response()->json(['message' => 'Véhicule non trouvé'], 404);
            }
            catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }
 //Supprimer
    public function destroy(Request $request)
        {
            try {
                    $userAutoecoleId = $request->session()->get('user_autoecole_id');
                    $request->merge(['autoecole_id' => $userAutoecoleId]);
                   $vehicule = Vehicule::where('id', $request->id)
                     ->where('autoecole_id', $request->autoecole_id)
                     ->firstOrFail();

                    $vehicule->delete();
                    
                    return response()->json(['message' => 'Le véhicule a été supprimé avec succès'], 201);
            } catch (\ModelNotFoundException $exception) {
                return response()->json(['message' => 'Véhicule non trouvé'], 404);
            }catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }    
 //Afficher tous
    public function allData(Request $request){
        
        try{

            $userAutoecoleId = $request->session()->get('user_autoecole_id');
            $request->merge(['autoecole_id' => $userAutoecoleId]);
           $vehicules = Vehicule::where('autoecole_id', $request->autoecole_id)->get();
           if ($vehicules->isEmpty()) {
            return response()->json(['message' => 'Aucun véhicule trouvé dans cette auto-école.'], 404);
        }
        return response()->json($vehicules,201);
        }
        catch(\Exception $e){
            return response()->json($e->getMessage(),500);
            //"Une erreur est survenue lors de la recherche"
        }
    }

//Modifier par id
    public function edit(Request $request)
        {
            try {
                $userAutoecoleId = $request->session()->get('user_autoecole_id');
                $request->merge(['autoecole_id' => $userAutoecoleId]);
                $validatedData =Validator::make($request->all(), [
                    'autoecole_id'=>'nullable|integer',
                    'img_carte_grise' => 'nullable|string',
                    'img_assurance' => 'nullable|string',
                    'vignette' => 'nullable|string',
                    'visite_tech' => 'nullable|string',
                    'modele' => 'nullable|string',
                    'matricule' => 'nullable|integer|unique:vehicules',
                    'fornisseur' => 'nullable|string',
                    'marque' => 'nullable|string',
                    'categorie_permis' => 'nullable|in:A,A1,AM,B,C,D,EB,EC,ED,F,FC',
                    'date_p_visete_technique' => 'nullable|date',
                    'date_vidange' => 'nullable|date',
                    'date_e_assurance' => 'nullable|date',
                    'date_p_vidange' => 'nullable|date',
                    'date_assurance' => 'nullable|date',
                    'date_e_assurance' => 'nullable|date',
                
                ]);
                if ($validatedData->fails()) {
                    return response()->json(['errors' => $validatedData->errors()], 422);
                }
               // $vehicule = Vehicule::findOrFail($request->id);
              $vehicule = Vehicule::where('id', $request->id)
                     ->where('autoecole_id', $request->autoecole_id)
                     ->firstOrFail();

               /* if ($request->has('autoecole_id')) {
                    $vehicule->autoecole_id = $request->autoecole_id;
                }*/
                if ($request->has('img_carte_grise')) {
                    $vehicule->img_carte_grise = $request->img_carte_grise;
                }
                if ($request->has('img_assurance')) {
                    $vehicule->img_assurance = $request->img_assurance;
                }
                if ($request->has('img_visite_tech')) {
                    $vehicule->img_visite_tech = $request->img_visite_tech;
                }
                if ($request->has('img_vignette')) {
                    $vehicule-> img_vignette = $request-> img_vignette;
                }
            
                if ($request->has('modele')) {
                    $vehicule->modele = $request->modele;
                }
                if ($request->has('matricule')) {
                    $vehicule->matricule = $request->matricule;
                }
                if ($request->has('fornisseur')) {
                    $vehicule->fornisseur = $request->fornisseur;
                }
                if ($request->has('marque')) {
                    $vehicule->marque = $request->marque;
                }
                if ($request->has('categorie_permis')) {
                    $vehicule->categorie_permis = $request->categorie_permis;
                }
                if ($request->has('date_p_visete_technique')) {
                    $vehicule->date_p_visete_technique = $request->date_p_visete_technique;
                }
                if ($request->has('date_vidange')) {
                    $vehicule->date_vidange = $request->date_vidange;
                }

                if ($request->has('date_p_vidange')) {
                    $vehicule->date_p_vidange = $request->date_p_vidange;
                }
                if ($request->has('date_assurance')) {
                    $vehicule->date_assurance = $request->date_assurance;
                }
                if ($request->has('date_e_assurance')) {
                    $vehicule->date_e_assurance = $request->date_e_assurance;
                }
                $vehicule->save();
                  return response()->json("Mise à jour réussie avec succès", 201);
            } catch (\ModelNotFoundException $exception) {
                return response()->json("Véhicule non trouvé", 404);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }
 //Afficher les etas des date Vidange:
    public function checkVidange(Request $request)
        {   
            try{
                    $userAutoecoleId = $request->session()->get('user_autoecole_id');
                    $request->merge(['autoecole_id' => $userAutoecoleId]);
                    
                    $vehicule = Vehicule::where('id', $request->id)
                     ->where('autoecole_id', $request->autoecole_id)
                     ->firstOrFail();
                     //$vehicule = Vehicule::findOrFail($request->id);
                     $aujourdHui = Carbon::now(); 
                     if ($vehicule->date_p_vidange) {
                         $diffJours = $aujourdHui->diffInDays($vehicule->date_p_vidange, false); // Différence en jours
                         
                         if ($diffJours <= 10 && $diffJours >= 0) {
                             $message = "Attention";
                         } elseif ($vehicule->date_p_vidange < $aujourdHui) {
                             $message = "Urgent";
                         } else {
                             $message = "Pas encore";
                         }
                     } else {
                         $message = "Pas encore";
                     }
                    
                    return response()->json(['message' => $message]);
            } catch (\ModelNotFoundException $exception) {
                    return response()->json("Véhicule non trouvé", 404);
            }catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            }    
        }
//Afficher les etas des date Assurance:
    public function checkAssurance(Request $request)
         {
            try{
                    $userAutoecoleId = $request->session()->get('user_autoecole_id');
                    $request->merge(['autoecole_id' => $userAutoecoleId]);
                    
                    $vehicule = Vehicule::where('id', $request->id)
                     ->where('autoecole_id', $request->autoecole_id)
                     ->firstOrFail();
               // $vehicule = Vehicule::findOrFail($request->id);
                    $aujourdHui = Carbon::now(); 
                    if ($vehicule->date_e_assurance) {
                        $diffJours = $aujourdHui->diffInDays($vehicule->date_e_assurance, false); // Différence en jours
                        
                        if ($diffJours <= 10 && $diffJours >= 0) {
                            $message = "Attention";
                        } elseif ($vehicule->date_e_assurance < $aujourdHui) {
                            $message = "Urgent";
                        } else {
                            $message = "Pas encore";
                        }
                    } else {
                        $message = "Pas encore";
                    }

                return response()->json(['message' => $message]);
            } catch (\ModelNotFoundException $exception) {
                return response()->json("Véhicule non trouvé", 404);
            }catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            } 
        }
//Afficher les etas des date Visite Tech:
    public function checkVisiteTech(Request $request)
        {
            try{
                    $userAutoecoleId = $request->session()->get('user_autoecole_id');
                    $request->merge(['autoecole_id' => $userAutoecoleId]);
                    
                    $vehicule = Vehicule::where('id', $request->id)
                     ->where('autoecole_id', $request->autoecole_id)
                     ->firstOrFail();
               // $vehicule = Vehicule::findOrFail($request->id);
                    $aujourdHui = Carbon::now(); 
                    if ($vehicule->date_p_visete_technique) {
                        $diffJours = $aujourdHui->diffInDays($vehicule->date_p_visete_technique, false); // Différence en jours
                        
                        if ($diffJours <= 10 && $diffJours >= 0) {
                            $message = "Attention";
                        } elseif ($vehicule->date_p_visete_technique < $aujourdHui) {
                            $message = "Urgent";
                        } else {
                            $message = "Pas encore";
                        }
                    } else {
                        $message = "Pas encore";
                    }
                    return response()->json(['message' => $message]);
            } catch (\ModelNotFoundException $exception) {
                return response()->json("Véhicule non trouvé", 404);
            }catch (\Exception $e) {
                return response()->json($e->getMessage(), 500);
            } 
        }

          


 public function showVehiclesList(Request $request)
{
    $userAutoecoleId = $request->session()->get('user_autoecole_id');
    $request->merge(['autoecole_id' => $userAutoecoleId]);
    
    if (!empty($request->vehicle_ids)) {
        $vehicles = Vehicule::whereIn('id', $request->vehicle_ids)
            ->where('autoecole_id', $request->autoecole_id)
            ->get();
            if ($vehicles->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun véhicule trouvé pour l\'auto-école spécifiée et les IDs de véhicule donnés.'
                ], 404);
            }
        return response()->json([
            'vehicules' => $vehicles
        ]);
    } else {
        return response()->json([
            'message' => 'Aucun ID de véhicule spécifié.'
        ], 400);
    }
}

      
public function getVehiclesByCategory(Request $request) {
    try {
        $userAutoecoleId = $request->session()->get('user_autoecole_id');
        $request->merge(['autoecole_id' => $userAutoecoleId]);
        
        $vehicules = Vehicule::where('autoecole_id', $request->autoecole_id)
                             ->where('categorie_permis', $request->categorie_permis)
                             ->get(['id', 'marque']);
        if ($vehicules->isEmpty()) {
            return response()->json(['message' => 'Aucun véhicule trouvé pour cette catégorie.'], 404);
        }
        return response()->json($vehicules, 200);
    } catch(\Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
}




public function showById(Request $request, $id)
{
    try {
        $userAutoecoleId = $request->session()->get('user_autoecole_id');
        $request->merge(['autoecole_id' => $userAutoecoleId]);

        $vehicule = Vehicule::where('id', $id)
            ->where('autoecole_id', $request->autoecole_id)
            ->firstOrFail();
            
        return response()->json(['vehicule' => $vehicule]);
    } catch (\ModelNotFoundException $exception) {
        return response()->json(['message' => 'Véhicule non trouvé'], 404);
    } catch (\Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
}


}