<?php
namespace App\Http\ViewComposers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer {
    public function compose(View $view){
        
        //use cache
        $mostCommented = Cache::remember('mostCommented',now()->addSeconds(15),function(){
            return Post::mostCommented()->take(5)->get();
        });
        $mostAciveUsers = Cache::remember('mostAciveUsers',now()->addSeconds(15),function(){
            return User::mostActiveUsers()->take(5)->get();
        });
        $activeUserLastMonth = Cache::remember('activeUserLastMonth',now()->addSeconds(15),function(){
            return User::activeUserLastMonth()->take(5)->get();
        });

        $view->with([
            'mostCommented' => $mostCommented, 
            'mostAciveUsers' => $mostAciveUsers,
            'activeUserLastMonth' => $activeUserLastMonth,
        ]);
    }
}