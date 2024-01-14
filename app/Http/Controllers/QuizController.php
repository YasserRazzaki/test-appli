<?php

namespace App\Http\Controllers;

use App\Models\QuizJoueur;
use App\Models\QuizLogo;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function indexLogo()
    { $quizData = QuizLogo::all();
      return response()->json($quizData);
    }
    public function indexJoueur()
    { $quizJouData = QuizJoueur::all();
      return response()->json($quizJouData);
    }
}

/*
public function indexLogoRandom()
{  
    $quiz = QuizLogo::inRandomOrder()->first();
    if ($quiz) {
        return $quiz;
    } else {
        return response()->json(['message' => 'Aucun enregistrement trouvé.'], 404);
    } 
}

public function getOtherAnswers($currentQuestionId)
{
$currentQuestion = QuizLogo::find($currentQuestionId);

if (!$currentQuestion) {
    return response()->json(['message' => 'Question introuvable'], 404);
}

$currentAnswer = $currentQuestion->propositions;

$otherAnswers = QuizLogo::where('id', '!=', $currentQuestionId)
                        ->pluck('propositions');

return response()->json([
    'currentAnswer' => $currentAnswer,
    'otherAnswers' => $otherAnswers,
]);
}


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
*/


      //$quizData = QuizLogo::find($id);
      //return response()->json($quizData);

   // public function responseLogo(QuizLogo $question, Request $request){
        //validator request -> utilisateur a bien saisis une reponse
        // in_array($qestion->proposition, $request->reponse)
        // (en cas de soucis faire un json decode sur $qestion->proposition)