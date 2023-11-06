<?php

namespace App\Http\Controllers;

use App\Models\QuizLogo;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function indexLogo()
    {
     //   if (auth()->check()) {
        $quiz = QuizLogo::inRandomOrder()->first();
        if ($quiz) {
            return $quiz;
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé.'], 404);
        }
    }
//}
    public function indexJoueur(){
        $quizJoueur = QuizLogo::inRandomOrder()->first();
        $quizJoueur->save();
        if ($quizJoueur) {
            return response()->json([
                'nom_joueur' => $quizJoueur->nom,
                'club' => $quizJoueur->club,
                'age' => $quizJoueur->age,
                'poste' => $quizJoueur->poste,
                'nationalite' => $quizJoueur->nationalite,
                'image' => $quizJoueur->image,
                'propositions' => $quizJoueur->propositions
            ]);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé.'], 404);
        }
    }
    }
