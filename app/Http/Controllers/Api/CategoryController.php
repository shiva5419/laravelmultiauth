<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expensive;
use Validator;

class CategoryController extends Controller
{
    //
    public function index() 
    {

        $category = Category::where('status', '1')->get();

        return response()->json([
                   'status' => true,
                   'data' => $category,
        ],200);
    }

    public function add_expensive(Request $request) 
    {


        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'amount' => 'required|digits_between:0.00,999999.99',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }

        try{
            $data = ['user' => auth()->user()->id,
                    'category' => $request->category,
                    'amount' => $request->amount,
                    ];
            Expensive::create($data);
            return response()->json(['status'=> true,
                                     'message' => 'Added expensive successfully'
                                 ], 200);
        }
        catch(Exception $e){
            return response()->json([ 
                'status'=> false,
                "error" => "could_not_added",
                "message" => "Unable to added expensive"
            ], 400);
        }
    }

    public function expensive_list(Request $request) 
    {
        
        try {

            $expensive = Expensive::where('user', auth()->user()->id);
            if ($request->month != '') {
                $expensive = $expensive->whereMonth('created_at', $request->month);
            }
            if ($request->year != '') {
                $expensive = $expensive->whereYear('created_at', $request->year);
            }
            if ($request->date != '') {
                $newDateFormat = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
                $expensive = $expensive->whereDate('created_at', $newDateFormat);
            }
            $expensive = $expensive->get();

            if(count($expensive) > 0) {
                $message = 'Expensive List';
            } else {
                $message = 'No Expensive';
            }
            return response()->json(['status'=> true,
                                     'message' => $message,
                                     'data' => $expensive,
                                 ], 200);
        }
        catch (Exception $e) {
            return response()->json([ 
                'status'=> false,
                "error" => "could_not_list",
                "message" => "Unable to List expensive"
            ], 400);
        }

    }
}
