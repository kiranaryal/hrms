<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function generate($experience)
    {
$X = [1, 2, 3, 4, 5,10,20,30,50,75,100]; // Experience
$Y = [25000, 35000, 45000, 55000, 65000,85000,90000,100000,150000,200000,250000]; // Salary

// Function to calculate the mean value of an array
function mean($array) {
    return array_sum($array) / count($array);
}

// Function to perform linear regression
function linearRegression($X, $Y) {
    $n = count($X);

    // Calculate the mean of X and Y
    $meanX = mean($X);
    $meanY = mean($Y);

    // Calculate the slope and intercept of the regression line
    $numerator = 0;
    $denominator = 0;
    for ($i = 0; $i < $n; $i++) {
        $numerator += ($X[$i] - $meanX) * ($Y[$i] - $meanY);
        $denominator += pow($X[$i] - $meanX, 2);
    }
    $slope = $numerator / $denominator;
    $intercept = $meanY - $slope * $meanX;

    // Predict the values of Y for the given X
    $predictedY = [];
    for ($i = 0; $i < $n; $i++) {
        $predictedY[] = $slope * $X[$i] + $intercept;
    }

    // Calculate the coefficient of determination (R-squared)
    $totalSumOfSquares = 0;
    $residualSumOfSquares = 0;
    for ($i = 0; $i < $n; $i++) {
        $totalSumOfSquares += pow($Y[$i] - $meanY, 2);
        $residualSumOfSquares += pow($Y[$i] - $predictedY[$i], 2);
    }
    $rSquared = 1 - ($residualSumOfSquares / $totalSumOfSquares);

    return [
        'slope' => $slope,
        'intercept' => $intercept,
        'predictedY' => $predictedY,
        'rSquared' => $rSquared,
    ];
}

// Call the linearRegression function with the sample data
$regressionResult = linearRegression($X, $Y);

// Predict the salary for a given experience
$experience = $experience;
$predictedSalary = $regressionResult['slope'] * $experience + $regressionResult['intercept'];

return response()->json((int)$predictedSalary);

    }

}
