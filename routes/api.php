<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list.json', function () {
  $files = glob('data/*.{json}', GLOB_BRACE);
  $returnArray = [];
  foreach($files as $file) {
    $inp = file_get_contents($file);
    $tempArray = json_decode($inp, true);
    if (!array_key_exists($tempArray['survey']['code'], $returnArray)) { //the survey code is new, so add to $returnArray
      $returnArray[$tempArray['survey']['code'] . ' / ' . $tempArray['survey']['name']] = action([ListController::class, 'show'], ['id' => $tempArray['survey']['code']]);
    }
  }
  return json_encode($returnArray, JSON_UNESCAPED_SLASHES);
});

Route::get('{code}.json', function ($code) {
  $files = glob('data/*.{json}', GLOB_BRACE);
  $mainArray = [];
  foreach($files as $file) {
    $inp = file_get_contents($file);
    $tempArray = json_decode($inp, true);
    array_push($mainArray, $tempArray);
  }

  $filteredArray = [];
  foreach ($mainArray as $singleSurvey) {
    if ($singleSurvey['survey']['code'] == $code) {
      $filteredArray[] = $singleSurvey;
    }
  }

  if(!$filteredArray) { // no survey submissions are associated with this code, so return an empty array
    return json_encode($filteredArray);
  }

  $aggregateAnswers = [];
  foreach ($filteredArray[0]['questions'] as $question) {
    if ($question['type'] == 'qcm') { //conditions if type of question is qcm
      $options = [];
      foreach ($question['options'] as $option) {
        $options[$option] = 0;
      }
      $aggregateAnswers[] = [
        'type' => $question['type'],
        'label' => $question['label'],
        'result' => $options,
      ];
    } else if ($question['type'] == 'numeric') { //conditions if type of question is numeric
      $aggregateAnswers[] = [
        'type' => $question['type'],
        'label' => $question['label'],
        'result' => 0,
      ];
    }
  }

  foreach ($filteredArray as $singleSurvey) { // loop over all submissions with the same code, and complete the aggregation process
    $questionCounter = 0;
    foreach ($singleSurvey['questions'] as $question) {
      if ($question['type'] == 'qcm') {
        $optionsCounter = 0;
        foreach ($question['answer'] as $answer) {
          if($answer) {
            $aggregateAnswers[$questionCounter]['result'][$question['options'][$optionsCounter]]++;
          }
          $optionsCounter++;
        }
      } else if ($question['type'] == 'numeric') {
        $aggregateAnswers[$questionCounter]['result'] += $question['answer'];
      }
      $questionCounter++;
    }
  }

  return json_encode($aggregateAnswers);
})->name('survey.aggregate');
