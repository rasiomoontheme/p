<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "LoginController@showLoginForm");

Route::middleware("language")->name("admin.")->group(function () {
    Route::get("login", "LoginController@showLoginForm")->name("login");
    Route::post("login", "LoginController@login")->name("post_login");
    Route::get("iconlist", "IndexController@iconlist")->name("iconlist");
    Route::get("gamerecord/total", "IndexController@gamerecord_total")->name("gamerecord.total");
    Route::get("gamerecord/pull", "IndexController@gamerecord_pull")->name("gamerecord.pull");
    Route::get("gamerecord/fd", "IndexController@agent_fd_cron")->name("gamerecord.fd");
    Route::get("gamerecord/check", "IndexController@transfer_check")->name("gamerecord.bd");
    Route::post("fix/url", "IndexController@fix_url")->name("fix.url");
    Route::middleware("auth:web")->group(function () {
        Route::any("logout", "LoginController@logout")->name("logout");
        Route::get("main", "IndexController@main")->name("main");
        Route::get('picture/upload', "IndexController@picture_upload")->name('picture.upload');
        Route::get("system/iplist/all", "SystemConfigsController@config_iplist");
        Route::get("system/iplist/add", "SystemConfigsController@add_iplist");
        Route::get("system/iplist/clear", "SystemConfigsController@clear_iplist");
        Route::middleware(["rbac.admin"])->group(function () {
            Route::resource("index", "IndexController")->only(["index"]);
            Route::post("notice", "IndexController@notice_undeal")->name('notice');
            Route::get("user/export", "UsersController@export")->name("users.export");
            Route::get("user/info", "UsersController@userinfo")->name("user.info");
            Route::get("user/lang", "UsersController@lang")->name("user.lang");
            Route::post("user/lang", "UsersController@post_lang")->name("user.post_lang");
            Route::get("user/modify_pwd", "UsersController@modify_pwd")->name("user.modify_pwd");
            Route::post("user/modify_pwd", "UsersController@post_modify_pwd")->name("user.post_modify_pwd");
            Route::get("users/assign/{user}", "UsersController@assign")->name("users.assign");
            Route::post("users/assign/{user}", "UsersController@post_assign")->name("users.post_assign");
            Route::get("user/google", "UsersController@google_secret")->name("user.google");
            Route::post("user/google", "UsersController@post_google_secret")->name("user.post_google");
            Route::post("users/reset/google/{user}", "UsersController@post_reset_google")->name("user.post_reset_google");
            Route::resource("users", "UsersController")->except("show");

            Route::get("roles/assign/{role}", "RolesController@assign")->name("roles.assign");
            Route::post("roles/assign/{role}", "RolesController@post_assign")->name("roles.post_assign");
            Route::resource("roles", "RolesController");

            Route::get('permissions/create/{pid?}', 'PermissionsController@createOrChild')->name('permissions.create');
            Route::resource("permissions", "PermissionsController")->except("create");

            Route::resource("adminlogs", "AdminLogsController")->only(['index', 'show', 'destroy']);
            Route::get("adminlog/type/login", "AdminLogsController@typelogin")->name("adminlogs.type.login");
            Route::get("adminlog/type/logout", "AdminLogsController@typelogout")->name("adminlogs.type.logout");
            Route::get("adminlog/type/action", "AdminLogsController@typeaction")->name("adminlogs.type.action");
            Route::get("adminlog/type/system", "AdminLogsController@typesystem")->name("adminlogs.type.system");

            Route::get("systemconfigs/group", "SystemConfigsController@config_groups")->name("systemconfigs.config_groups");
            Route::get("systemconfigs/content", "SystemConfigsController@config_content")->name("systemconfigs.config_content");
            Route::get("systemconfigs/app_content", "SystemConfigsController@config_app_content")->name("systemconfigs.config_app_content");

            Route::get("systemconfigs/lang_setting", "SystemConfigsController@lang_setting")->name("systemconfigs.lang_setting");
            Route::post("systemconfigs/lang/default", "SystemConfigsController@post_lang_default")->name("systemconfigs.post_lang_default");
            Route::post("systemconfigs/lang/fields", "SystemConfigsController@post_lang_fields")->name("systemconfigs.post_lang_fields");
            Route::post("systemconfigs/post", "SystemConfigsController@post_config_groups")->name("systemconfigs.post_config_groups");
            Route::get("systemconfigs/export", "SystemConfigsController@export_config")->name("systemconfigs.export");
            Route::any("systemconfig/sync", "SystemConfigsController@updateConfigsByName")->name('systemconfig.sync');
            Route::any("systemconfig/sync2", "SystemConfigsController@CheckAgentConfigsByName")->name('systemconfig.checkagentsync');
            Route::resource("systemconfigs", "SystemConfigsController");

            Route::resource("attachments", "AttachmentsController")->only(['index', 'show', 'destroy']);

            Route::resource("banners", "BannersController");

            Route::resource("abouts", "AboutsController");

            Route::get("activity/type", "ActivitiesController@activity_type")->name('activity.type');
            Route::post("activity/type", "ActivitiesController@post_activity_type")->name('activity.post_type');

            Route::get("activity/app", "ActivitiesController@app_index")->name('activity.app_index');
            Route::resource("activities", "ActivitiesController");

            Route::get('member/register_setting', 'MembersController@register_setting')->name('member.register_setting');
            Route::post('member/register_setting', 'MembersController@post_register_setting')->name('member.post_register_setting');

            Route::post('member/make_offline/{member}', 'MembersController@make_offline')->name('member.make_offline');

            Route::get('member/modify_money/{member}', 'MembersController@modify_money')->name('member.modify_money');
            Route::post('member/modify_money/{member}', 'MembersController@post_modify_money')->name('member.post_modify_money');
            Route::get('member/modify_top/{member}', 'MembersController@modify_top')->name('member.modify_top');
            Route::post('member/modify_top/{member}', 'MembersController@post_modify_top')->name('member.post_modify_top');
            Route::get('member/money_report', 'MembersController@money_report')->name('member.money_report');
            Route::get('member/member_apis/{member}', 'MembersController@member_apis')->name('member.member_apis');
            Route::post('member/refresh_api/{member_api}', 'MembersController@refresh_api')->name('member.refresh_api');
            Route::post('member/changepassword_api/{member_api}', 'MembersController@changepassword_api')->name('member.changepassword_api');
            Route::post('member/checkproduct_api', 'MembersController@checkproduct_api')->name('member.checkproduct_api');
            Route::post('member/recycle_api/{member_api}', 'MembersController@recycle_api')->name('member.recycle_api');
            Route::resource("members", "MembersController")->except('show');

            Route::resource("membermoneylogs", "MemberMoneyLogsController")->only(['index', 'show', 'destroy']);

            Route::get("systemnotices/app", "SystemNoticesController@app_index")->name('systemnotice.app');
            Route::resource("systemnotices", "SystemNoticesController");

            Route::resource("bankcards", "BankCardsController");

            Route::get("api/refresh", "ApisController@refresh")->name('api.refresh');
            Route::get("api/pull", "ApisController@pull")->name('api.pull');
            Route::resource("apis", "ApisController")->except('show');

            Route::get('apigames/mobile_category', 'ApiGamesController@mobile_category')->name('apigames.mobile_category');
            Route::post('apigames/mobile_category', 'ApiGamesController@mobile_category_save')->name('apigames.mobile_category_save');
            Route::post('apigames/web_category', 'ApiGamesController@web_category_save')->name('apigames.web_category_save');

            Route::resource("apigames", "ApiGamesController");

            Route::get('agents/assign/{member}', 'AgentsController@assign')->name('agents.assign');
            Route::post('agents/assign/{member}', 'AgentsController@post_assign')->name('agents.post_assign');
            Route::resource("agents", "AgentsController")->except(['create', 'store']);

            Route::resource("memberagentapplies", "MemberAgentAppliesController")->except('create', 'store');

            Route::get("recharges/confirm/{recharge}/{status}", "RechargesController@confirm")->name("recharges.confirm");
            Route::post("recharges/confirm/{recharge}", "RechargesController@post_confirm")->name("recharges.post_confirm");
            Route::post("recharges/reject/{recharge}", "RechargesController@post_reject")->name("recharges.post_reject");
            Route::get("recharges/payment/{recharge}", "RechargesController@payment_detail")->name('recharges.payment_detail');
            Route::resource("recharges", "RechargesController")->except("create", "store", "edit");

            Route::resource("memberbanks", "MemberBanksController")->only("index", "show", "edit", "update");

            Route::get("drawings/confirm/{drawing}/{status}", "DrawingsController@confirm")->name("drawings.confirm");
            Route::post("drawings/confirm/{drawing}", "DrawingsController@post_confirm")->name("drawings.post_confirm");
            Route::post("drawings/reject/{drawing}", "DrawingsController@post_reject")->name("drawings.post_reject");
            Route::resource("drawings", "DrawingsController")->except("create", "store", "edit");
            Route::get("drawings_setting_size", "DrawingsController@setting_size")->name('drawings.setting_size');
            Route::post("drawings_setting_size", "DrawingsController@post_setting_size")->name('drawings.post_setting_size');

            Route::resource("gamelists", "GameListsController");

            Route::resource("transfers", "TransfersController")->only(["index", "show", "destroy"]);
            Route::post('transfers/TransactionStatus', 'TransfersController@TransactionStatus')->name('transfers.TransactionStatus');
            Route::get("messages/index/member", "MessagesController@index_member")->name('messages.index_member');
            Route::get("messages/reply/{message}", "MessagesController@reply")->name('messages.reply');
            Route::get("messages/history/{message}", "MessagesController@history")->name('messages.history');
            Route::post("messgaes/reply/{message}", "MessagesController@post_reply")->name('messages.post_reply');
            Route::post('messgaes/mark', "MessagesController@post_mark_deal")->name('messages.post_mark_deal');
            Route::resource("messages", "MessagesController");

            Route::resource("gamerecords", "GameRecordsController")->only(['index', 'destroy', 'show']);

            Route::get("dailybonus/setting", "DailyBonusesController@setting")->name('dailybonus.setting');
            Route::post("dailybonus/setting", "DailyBonusesController@post_setting")->name('dailybonus.post_setting');
            Route::get("dailybonus/setting_size", "DailyBonusesController@setting_size")->name('dailybonus.setting_size');
            Route::post("dailybonus/setting_size", "DailyBonusesController@post_setting_size")->name('dailybonus.post_setting_size');
            Route::get("dailybonus/setting_desc", "DailyBonusesController@setting_desc")->name('dailybonus.setting_desc');
            Route::post("dailybonus/setting_desc", "DailyBonusesController@post_setting_desc")->name('dailybonus.post_setting_desc');
            Route::get("dailybonus/redbag_log", "DailyBonusesController@get_redbag_log")->name('dailybonus.get_redbag_log');

            Route::get("dailybonus/member", "DailyBonusesController@record_list")->name('dailybonuses.record_list');
            Route::post("dailybonus/member/{dailybonus}/{state}", "DailyBonusesController@modify_state")->name('dailybonuses.modify_state');
            Route::resource("dailybonuses", "DailyBonusesController");

            Route::get("activityapplies/{activityapply}/confirm/{status}", "ActivityAppliesController@confirm")->name('activityapplies.confirm');
            Route::post("activityapplies/{activityapply}/confirm/{status}", "ActivityAppliesController@post_confirm")->name('activityapplies.post_confirm');
            Route::get("activityapplies/{activityapply}/bonus", "ActivityAppliesController@bonus")->name('activityapplies.bonus');
            Route::post("activityapplies/{activityapply}/bonus", "ActivityAppliesController@post_bonus")->name('activityapplies.post_bonus');
            Route::resource("activityapplies", "ActivityAppliesController")->only(['index', 'show', 'destroy']);

            Route::resource("blackips", "BlackIpsController");

            Route::resource("memberlogs", "MemberLogsController")->only(['index', 'show', 'destroy']);

            Route::get("task/level_setting", "TasksController@level_setting")->name('task.level_setting');
            Route::post("task/level_setting/{level}/{type}", "TasksController@post_level_setting")->name('task.post_level_setting');
            Route::delete("task/level_setting/{level}/{type}", "TasksController@delete_level_setting")->name('task.delete_level_setting');
            Route::resource("tasks", "TasksController");

            Route::resource("fslevels", "FsLevelsController");
            Route::get('fslevel/batch_create', "FsLevelsController@batch_create")->name('fslevels.batch_create');
            Route::post('fslevel/batch_create', "FsLevelsController@post_batch_create")->name('fslevels.post_batch_create');

            Route::resource("sendfs", "SendFsController")->only(['index', 'store']);
            Route::get('test', 'SendFsController@test')->name('test');

            Route::resource("sendagent", "SendAgentController")->only(['index', 'store']);
            Route::resource("yjlevels", "YjLevelsController");

            Route::resource("agentyjlogs", "AgentYjLogsController")->only(['index', 'destroy']);
            Route::get('agentyjlog/{agent}', 'AgentYjLogsController@history')->name('agentyjlog.history');

            Route::resource("agentfdrates", "AgentFdRatesController");
            Route::get("agentfdrate/system", "AgentFdRatesController@system")->name('agentfdrate.system');
            Route::post("agentfdrate/system", "AgentFdRatesController@post_system")->name('agentfdrate.post_system');
            Route::get("agentfdrate/agent/{agent}", "AgentFdRatesController@agent")->name('agentfdrate.agent');
            Route::post("agentfdrate/agent/{agent}", "AgentFdRatesController@post_agent")->name('agentfdrate.post_agent');

            Route::resource("agentfdmoneylogs", "AgentFdMoneyLogsController");//->only('index','show','destroy');
            Route::post('agentfdmoneylog/{gamerecord}/handle', 'AgentFdMoneyLogsController@handle_record')->name('agentfdmoneylog.handle_record');


            Route::get("agent/active_member", "AgentsController@active_member")->name('agent.active_member');
            Route::post("agent/active_member", "AgentsController@post_active_member")->name('agent.post_active_member');

            Route::get("quick/arbitrage_query", "QuickController@arbitrage_query")->name('quick.arbitrage_query');
            Route::get("quick/member_arbitrage_query", "QuickController@member_arbitrage_query")->name('quick.member_arbitrage_query');

            Route::get("quick/transfer_check", "QuickController@transfer_check")->name('quick.transfer_check');

            Route::post("quick/add_transfer", "QuickController@add_transfer")->name('quick.add_transfer');

            Route::get("quick/database_clean", "QuickController@database_clean")->name('quick.database_clean');

            Route::post("quick/database_clean", "QuickController@post_database_clean")->name('quick.post_database_clean');

            Route::resource('payments', 'PaymentsController');

            Route::resource('yuebaoplans', "YuebaoPlansController");

            Route::get('memberyuebaoplans', "MemberYuebaoPlansController@index")->name("memberyuebaoplans.index");

            Route::get('memberyuebaoplans/interest/history/{plan}', "MemberYuebaoPlansController@interest_history")->name("memberyuebaoplans.interest_history");

            Route::post("memberwheels/ensure/{memberwheel}", "MemberWheelsController@ensure")->name('memberwheel.ensure');
            Route::get("memberwheels/setting", "MemberWheelsController@setting")->name("memberwheel.setting");
            Route::post("memberwheels/post_setting", "MemberWheelsController@post_setting")->name("memberwheel.post_setting");
            Route::resource('memberwheels', 'MemberWheelsController')->only(['index', 'show', 'destroy']);

            Route::resource('quickurls', 'QuickUrlsController');

            Route::resource('asideadvs', 'AsideAdvsController');

            Route::get('creditpayrecord/borrow', 'CreditPayRecordsController@borrow_record')->name('creditpayrecord.borrow');
            Route::get('creditpayrecord/lend', 'CreditPayRecordsController@lend_record')->name('creditpayrecord.lend');
            Route::post('creditpayrecord/confirm/{record}', 'CreditPayRecordsController@confirm')->name('creditpayrecord.confirm');
            Route::post('creditpayrecord/reject/{record}', 'CreditPayRecordsController@reject')->name('creditpayrecord.reject');
            Route::resource('creditpayrecords', 'CreditPayRecordsController');

            Route::resource('sports', 'SportsController');

            Route::resource('levelconfigs', 'LevelConfigsController');

            Route::resource('banks', 'BanksController');

            Route::resource('gamehots', 'GameHotController');
        });
    });
});
