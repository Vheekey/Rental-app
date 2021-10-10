<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start' => 'date',
            'end' => 'date',
        ]);

        $start = Carbon::parse($request->start)->startOfDay()->toDateTimeString() ?? Carbon::today()->toDateTimeString();
        $end = Carbon::parse($request->end)->endOfDay()->toDateTimeString() ?? Carbon::today()->endOfDay()->toDateTimeString();

        $returned = Activity::RETURNED;
        $rented = Activity::RENTED;

        $activities = DB::table("activities")
            ->select(
                DB::raw('(SELECT count(*) from activities where item_type = '.DB::getPdo()->quote(Book::class).' AND status='.$returned.') as Books_Returned'),
                DB::raw('(SELECT count(*) from activities where item_type = '.DB::getPdo()->quote(Book::class).' AND status='.$rented.') as Books_Rented'),
                DB::raw('(SELECT count(*) from activities where item_type = '.DB::getPdo()->quote(Equipment::class).' AND  status='.$returned.') as Equipments_Returned'),
                DB::raw('(SELECT count(*) from activities where item_type = '.DB::getPdo()->quote(Equipment::class).' AND  status='.$rented.') as Equipments_Rented')
            )
            ->distinct()
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $period = "from ".$start." to ".$end;

        return view('welcome')->with('activities', (count($activities) > 0) ? json_encode($activities[0]) : json_encode([]))->with('period',$period);
    }

}
