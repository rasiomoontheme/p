<?php

use Illuminate\Database\Seeder;
use App\Models\AgentFdRate;

// php artisan db:seed --class=AgentFdRateSeeder
class AgentFdRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 系统最高
        $high = [
            ['game_type' => 1, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 2, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 3, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 4, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 5, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 6, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 7, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
            ['game_type' => 99, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEM_HIGHEST],
        ];

        foreach ($high as $item){
            AgentFdRate::create($item);
        }

        $low = [
            ['game_type' => 1, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 2, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 3, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 4, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 5, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 6, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 7, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
            ['game_type' => 99, 'rate' => 1.0,'type' => AgentFdRate::TYPE_SYSTEM_LOWEST],
        ];

        foreach ($low as $item){
            AgentFdRate::create($item);
        }

        $sys = [
            ['game_type' => 1, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 2, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 3, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 4, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 5, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 6, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 7, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
            ['game_type' => 99, 'rate' => 6.0,'type' => AgentFdRate::TYPE_SYSTEN_AGENT],
        ];

        foreach ($sys as $item){
            AgentFdRate::create($item);
        }
    }
}
