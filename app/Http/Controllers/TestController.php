<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee_stat;


class TestController extends Controller
{
    public function generate($exp)
    {

        $dataset = [
            ['experience' => 1, 'role' => 1, 'ranking' => 1, 'salary' => 30000],

            ['experience' => 2, 'role' => 1, 'ranking' => 1, 'salary' => 32500],
            ['experience' => 3, 'role' => 1, 'ranking' => 1, 'salary' => 35000],
            ['experience' => 4, 'role' => 1, 'ranking' => 1, 'salary' => 37500],
            ['experience' => 5, 'role' => 1, 'ranking' => 1, 'salary' => 40000],

            ['experience' => 1, 'role' => 2, 'ranking' => 1, 'salary' => 40000],
            ['experience' => 1, 'role' => 3, 'ranking' => 1, 'salary' => 45000],
            ['experience' => 1, 'role' => 4, 'ranking' => 1, 'salary' => 50000],
            ['experience' => 1, 'role' => 5, 'ranking' => 1, 'salary' => 55000],

            ['experience' => 1, 'role' => 1, 'ranking' => 2, 'salary' => 30500],
            ['experience' => 1, 'role' => 1, 'ranking' => 3, 'salary' => 31000],
            ['experience' => 1, 'role' => 1, 'ranking' => 4, 'salary' => 31500],
            ['experience' => 1, 'role' => 1, 'ranking' => 5, 'salary' => 42000],



        ];


        // Extract the relevant data for training the regression model
        $experience = array_column($dataset, 'experience');
        $role = array_column($dataset, 'role');
        $ranking = array_column($dataset, 'ranking');
        $salary = array_column($dataset, 'salary');

// Function to perform multiple linear regression
function multipleLinearRegression($experience, $role, $ranking, $salary) {
    $n = count($experience);

    // Calculate the means of each feature
    $meanExperience = array_sum($experience) / $n;
    $meanRole = array_sum($role) / $n;
    $meanRanking = array_sum($ranking) / $n;
    $meanSalary = array_sum($salary) / $n;

    // Calculate the coefficients (slopes) of the regression equation
    $numerator = 0;
    $denominator = 0;
    for ($i = 0; $i < $n; $i++) {
        $numerator += ($experience[$i] - $meanExperience) * ($role[$i] - $meanRole) * ($ranking[$i] - $meanRanking) * ($salary[$i] - $meanSalary);
        $denominator += pow($experience[$i] - $meanExperience, 2) * pow($role[$i] - $meanRole, 2) * pow($ranking[$i] - $meanRanking, 2);
    }

    $slope = $numerator / $denominator;

    // Calculate the intercept of the regression equation
    $intercept = $meanSalary - ($slope * $meanExperience * $meanRole * $meanRanking);

    return [
        'slope' => $slope,
        'intercept' => $intercept,
    ];
}

// Call the multipleLinearRegression function with the sample data
$regressionResult = multipleLinearRegression($experience, $role, $ranking, $salary);

// Predict the salary for a given set of experience, role, and ranking
$experienceToPredict = $exp; // Replace with the desired values
$get = employee_stat::where('user_id', auth()->user()->id)->first();

$roleToPredict =$get->role ?? 1;       // Replace with the desired values
$rankingToPredict =$get->ranking ?? 1;    // Replace with the desired values

$predictedSalary = $regressionResult['intercept'] +
                   $regressionResult['slope'] * $experienceToPredict * $roleToPredict * $rankingToPredict;

return response()->json((int)$predictedSalary);

    }



}
