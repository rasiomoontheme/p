<?php

namespace App\Providers;

use App\Models\Agent;
use App\Models\AgentFdRate;
use App\Models\Attachment;
use App\Models\DailyBonus;
use App\Models\Drawing;
use App\Models\InviteRate;
use App\Models\Member;
use App\Models\Message;
use App\Models\Permission;
use App\Models\Recharge;
use App\Models\User;
use App\Observers\AgentFdRateObserver;
use App\Observers\AgentObserver;
use App\Observers\AttachmentObserver;
use App\Observers\DailyBonusObserver;
use App\Observers\DrawingObserver;
use App\Observers\InviteRateObserver;
use App\Observers\MemberObserver;
use App\Observers\MessageObserver;
use App\Observers\PermissionObserver;
use App\Observers\RechargeObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Permission::observe(PermissionObserver::class);
        Attachment::observe(AttachmentObserver::class);
        Member::observe(MemberObserver::class);
        Agent::observe(AgentObserver::class);
        Message::observe(MessageObserver::class);
        DailyBonus::observe(DailyBonusObserver::class);
        AgentFdRate::observe(AgentFdRateObserver::class);
        Recharge::observe(RechargeObserver::class);
        Drawing::observe(DrawingObserver::class);
        InviteRate::observe(InviteRateObserver::class);
    }
}
