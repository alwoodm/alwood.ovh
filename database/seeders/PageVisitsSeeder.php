<?php

namespace Database\Seeders;

use App\Models\PageVisit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class PageVisitsSeeder extends Seeder
{
    /**
     * Seed visits data
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('page_visits')->truncate();
        Schema::enableForeignKeyConstraints();
        
        $faker = Faker::create();
        $pages = ['home', 'o-mnie', 'portfolio', 'kontakt', 'blog/post-1', 'blog/post-2'];
        $referrers = ['google.com', 'facebook.com', 'instagram.com', 'linkedin.com', '', null];
        $userAgents = [
            // Desktop
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
            'Mozilla/5.0 (X11; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0',
            
            // Mobile
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/89.0',
            'Mozilla/5.0 (iPad; CPU OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/91.0.4472.80 Mobile/15E148 Safari/604.1',
        ];
        
        // Last 30 days of data
        for ($day = 30; $day >= 0; $day--) {
            $date = Carbon::now()->subDays($day);
            $visitsCount = $faker->numberBetween(10, 100);
            
            for ($i = 0; $i < $visitsCount; $i++) {
                // Random distribution across hours
                $hour = $faker->numberBetween(0, 23);
                $minute = $faker->numberBetween(0, 59);
                $second = $faker->numberBetween(0, 59);
                
                $visitDate = $date->copy()->setTime($hour, $minute, $second);
                
                PageVisit::create([
                    'ip_hash' => hash('sha256', $faker->ipv4 . '_' . $faker->numberBetween(1, 100)),
                    'user_agent' => $faker->randomElement($userAgents),
                    'url' => $faker->randomElement($pages),
                    'referrer' => $faker->randomElement($referrers),
                    'visited_at' => $visitDate,
                ]);
            }
        }
    }
}
