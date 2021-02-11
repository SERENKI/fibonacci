<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FibonacciNumber;
use App\FibonacciClasses\FindFibonacci;

class FindFibonacciController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if ((!isset($request->number)) or (!is_numeric($request->number))) {
            return response()->json([
                'message' => 'Number is empty or entered data is not number!'
            ], 422);
        }

        //Get Fn-1, Fn, Fn+1
        $fibonacci = new FindFibonacci($request->number);

        //Add number to table
        $fibonacci_number = new FibonacciNumber;
        $fibonacci_number->number = $fibonacci->nearly;
        $fibonacci_number->save();

        return response()->json([
            'message' => $fibonacci->nearly
        ], 200);
    }
}
