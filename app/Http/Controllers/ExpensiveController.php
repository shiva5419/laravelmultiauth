<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expensive;
use App\Charts\SampleChart;
use Carbon\Carbon;



class ExpensiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $expensive = Expensive::select('expensive.id as id', \DB::raw("SUM(amount) as amount"), 'expensive.created_at', 'C.name as expensive', 'U.name as username' )
                    ->LeftJoin('category as C', 'C.id', '=',  'category')
                    ->LeftJoin('users as U', 'U.id', '=',  'user')
                    ->whereMonth('expensive.created_at', Carbon::today())
                    ->where('user', $id)
                    ->groupBy('category')
                    ->get();

        $data = [];
        foreach($expensive as $key => $row) {
            $data[] = ['label' => $row->expensive,
                        'y' => (int) $row->amount
                      ];
        } 
        $chardata = json_encode($data); 
        return view('expensive', compact('expensive', 'chardata'));
    }
}
