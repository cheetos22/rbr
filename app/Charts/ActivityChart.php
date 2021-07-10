<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $data = DB::table('posts')
                        ->join('users', 'posts.user_id', '=', 'users.user_id')
                        ->select('users.name','posts.user_id', DB::raw('count(posts.id) as total'))
                        ->where('posts.created_at', '>', Carbon::now()->addDays(-7))
                        ->groupBy('posts.user_id', 'users.name')
                        ->orderBy('total','desc')
                        ->get();

        $pluckedName = $data->pluck('name')->toArray();
        $pluckedLasted7DaysPosts = $data->pluck('total')->toArray();


        return Chartisan::build()
            ->labels($pluckedName)
            ->dataset('', $pluckedLasted7DaysPosts);
    }
}
