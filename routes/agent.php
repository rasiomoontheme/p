<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "LoginController@showLoginForm");

Route::middleware(['maintenance', 'language'])->name("agent.")->group(function () {
    Route::get("login", "LoginController@showLoginForm")->name("login");
    Route::post("login", "LoginController@login")->name("post_login");

    Route::middleware("auth:agent")->group(function () {
        Route::any("logout", "LoginController@logout")->name("logout");

        Route::resource("index", "IndexController")->only(["index"]);
        Route::get("main", "IndexController@main")->name("main");

        Route::get("agentmember/index", "AgentMemberController@index")->name("agentmember.index");

        Route::get("agent_fd_rate/{agent}", "MemberOfflineController@agent_fd_rate")->name("memberoffline.agent_fd_rate");
        Route::post("agent_fd_rate/{agent}", "MemberOfflineController@post_agent_fd_rate")->name("memberoffline.post_agent_fd_rate");

        Route::get("memberoffline/index", "MemberOfflineController@index")->name("memberoffline.index");
        Route::get("memberoffline/allagent", "MemberOfflineController@allagent")->name("memberoffline.allagent");
        Route::get("memberoffline/fd", "MemberOfflineController@fd_offline")->name("memberoffline.fd");
        Route::post("memberoffline/fd", "MemberOfflineController@post_fd_offline")->name("memberoffline.post_fd");

        Route::get("offlinemoneylog/index", "MemberOfflineController@money_log")->name("memberoffline.moneylog");
        Route::get("offlinemoneylog/{id}", "MemberOfflineController@money_log_show")->name("memberoffline.moneylog.show");
        Route::get("offlinedrawing/index", "MemberOfflineController@drawing_list")->name("memberoffline.drawinglist");
        Route::get("offlinerecharge/index", "MemberOfflineController@recharge_list")->name("memberoffline.rechargelist");
        Route::get("offlinegamerecord/index", "MemberOfflineController@gamerecords")->name("memberoffline.gamerecords");
        Route::get("offlinefdlog/index", "MemberOfflineController@agent_fd_logs")->name("memberoffline.agent_fd_logs");

        Route::get("total_sy/index", "MemberOfflineController@total_sy")->name("memberoffline.total_sy");
    });
});
