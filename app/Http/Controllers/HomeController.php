<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatisticsRequest;
use App\Models\Activity;
use App\Models\Book;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Get Dashboard statistics graph
     *
     * @param StatisticsRequest $request
     * @return void
     */

    public function index(StatisticsRequest $request)
    {
        $activities = $this->statistics($request);

        $period = "from ".($request->start ?? Carbon::today()->toDateString())." to ".($request->end ?? Carbon::today()->toDateString());

        return view('welcome')->with('activities', (count($activities) > 0) ? json_encode($activities[0]) : json_encode([]))->with('period',$period);
    }


    /**
     * Get statistics for api
     *
     * @param StatisticsRequest $request
     * @return void
     */

    public function apiStatistics(StatisticsRequest $request)
    {
        return $this->okResponse('Statistics Retrieved', $this->statistics($request));
    }

    /**
     * Compute Statistics
     *
     * @param Request $request
     * @return mixed
     */
    protected function statistics(Request $request)
    {

        $start = Carbon::parse($request->start)->startOfDay()->toDateTimeString() ?? Carbon::today()->toDateTimeString();
        $end = Carbon::parse($request->end)->endOfDay()->toDateTimeString() ?? Carbon::today()->endOfDay()->toDateTimeString();

        $returned = Activity::RETURNED;
        $rented = Activity::RENTED;

        return DB::table("activities")
            ->select(
                DB::raw('(SELECT count(*) from activities where itemable_type = '.DB::getPdo()->quote(Book::class).' AND status='.$returned.') as Books_Returned'),
                DB::raw('(SELECT count(*) from activities where itemable_type = '.DB::getPdo()->quote(Book::class).' AND status='.$rented.') as Books_Rented'),
                DB::raw('(SELECT count(*) from activities where itemable_type = '.DB::getPdo()->quote(Equipment::class).' AND  status='.$returned.') as Equipments_Returned'),
                DB::raw('(SELECT count(*) from activities where itemable_type = '.DB::getPdo()->quote(Equipment::class).' AND  status='.$rented.') as Equipments_Rented')
            )
            ->distinct()
            ->whereBetween('created_at', [$start, $end])
            ->get();
    }

}
