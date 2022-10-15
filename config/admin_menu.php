<?php

return [
    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'route_name' => 'admin.index.index',
        'child' => [
            [
                'name' => '??????',
                'is_show' => false,
                'child' => [
                    [
                        'name' => '??????',
                        'is_show' => false,
                        'route_name' => 'admin.user.info',
                    ],
                    [
                        'name' => '?????????',
                        'is_show' => false,
                        'route_name' => 'admin.user.google'
                    ],
                    [
                        'name' => '?????????',
                        'is_show' => false,
                        'route_name' => 'admin.user.post_google'
                    ],
                    [
                        'name' => '??????????',
                        'is_show' => false,
                        'route_name' => 'admin.user.modify_pwd',
                    ],
                    [
                        'name' => '??????????',
                        'is_show' => false,
                        'route_name' => 'admin.user.post_modify_pwd',
                    ], [
                        'name' => '????????',
                        'is_show' => false,
                        'route_name' => 'attachment.upload',
                    ], [
                        'name' => '????????',
                        'is_show' => false,
                        'route_name' => 'attachment.delete'
                    ]
                ]
            ],
            [
                'name' => '????',
                'route_name' => 'admin.index.index',
                'child' => []
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemconfigs.index',
                'is_show' => 0,
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.systemconfigs.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.systemconfigs.destroy',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.systemconfig.sync'
                    ]
                ]
            ],

            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemconfigs.config_groups',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.config_groups',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemconfigs.post_config_groups',
                    ]
                ]
            ],

            [
                'name' => '?????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemconfigs.lang_setting',
                'child' => [
                    [
                        'name' => '???????',
                        'route_name' => 'admin.systemconfigs.lang_setting',
                    ],

                    [
                        'name' => '??????????',
                        'route_name' => 'admin.systemconfigs.post_lang_default'
                    ],

                    [
                        'name' => '??????????',
                        'route_name' => 'admin.systemconfigs.post_lang_fields'
                    ]
                ]
            ],
        ],
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.members.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.members.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.members.create',
                    ],
                    // [
                    //     'name' => '??????',
                    //     'route_name' => 'admin.members.show',
                    // ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.members.store',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.members.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.members.update',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.members.destroy',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.member.modify_money',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.member.post_modify_money',
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.member.modify_top',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.member.post_modify_top',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agents.assign',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agents.post_assign',
                    ],[
                        'name' => '????????',
                        'route_name' => 'admin.member.member_apis'
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.member.refresh_api'
                    ],[
                        'name' => '???????',
                        'route_name' => 'admin.member.make_offline'
                    ],[
                        'name' => '??????',
                        'route_name' => 'admin.member.register_setting'
                    ],[
                        'name' => '????????',
                        'route_name' => 'admin.member.post_register_setting'
                    ]
                ]
            ],
            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberbanks.index',
                'child' => [
                    [
                        'name' => '???????',
                        'route_name' => 'admin.memberbanks.index',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.memberbanks.show',
                    ]
                ]
            ],
            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.gamerecords.index',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.gamerecords.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.gamerecords.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.gamerecords.destroy'
                    ]
                ]
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.banks.index',
                'child' => [
                    [
                        'name' => '???????',
                        'route_name' => 'admin.banks.index',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.banks.create',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.banks.show',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.banks.store',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.banks.edit',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.banks.update',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banks.destroy',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.payments.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.payments.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.payments.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.payments.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.payments.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.payments.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.payments.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.payments.destroy',
                    ]
                ]
            ],

            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.recharges.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.recharges.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.recharges.show',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.recharges.confirm'
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.recharges.post_confirm'
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.recharges.post_reject'
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.recharges.destroy',
                    ]
                ]
            ],
            [

                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.drawings.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.drawings.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.drawings.show',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.drawings.confirm'
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.drawings.post_confirm'
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.drawings.post_reject'
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.drawings.destroy',
                    ]
                ]
            ],
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.drawings.setting_size',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.drawings.setting_size',
                    ],
                    [
                        'name' => '????????',
                        'route_name' => 'admin.drawings.post_setting_size',
                    ],
                ]
            ],
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.transfers.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.transfers.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.transfers.show',
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.transfers.destroy',
                    ]
                ]
            ],

            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.member.money_report',
                'child' => []
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '??????',
                'pid' => null,
                'icon'=> 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.fslevels.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.fslevels.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.fslevels.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.fslevels.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.fslevels.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.fslevels.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.fslevels.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.fslevels.destroy',
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.fslevels.batch_create',
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.fslevels.post_batch_create',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon'=> 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.sendfs.index',
                'remark' => 'is_realtime_fs_mode=0',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.sendfs.index',
                    ],[
                        'name' => '????????',
                        'route_name' => 'admin.sendfs.store',
                    ]
                ]
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agents.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.agents.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.agents.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.agents.update',
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrate.agent'
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrate.post_agent'
                    ]
                ]
            ],

            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberagentapplies.index',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.memberagentapplies.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberagentapplies.show',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberagentapplies.edit'
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberagentapplies.update'
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.memberagentapplies.destroy',
                    ]
                ]
            ],

            // ????
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.yjlevels.index',
                'remark' => 'agent_fd_mode=0',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.yjlevels.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.yjlevels.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.yjlevels.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.yjlevels.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.yjlevels.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.yjlevels.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.yjlevels.destroy',
                    ]
                ]
            ],
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.sendagent.index',
                'remark' => 'agent_fd_mode=0',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.sendagent.index',
                    ],
                    [
                        'name' => '????????',
                        'route_name' => 'admin.sendagent.store',
                    ],
                ]
            ],
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agentyjlogs.index',
                'remark' => 'agent_fd_mode=0',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.agentyjlogs.index',
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.agentyjlog.history',
                    ],
                ]
            ],

            // ????
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agentfdrates.index',
                'remark' => 'agent_fd_mode=1',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdrates.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrates.show',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrates.create',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrates.store',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrates.edit',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.agentfdrates.update',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdrates.destroy',
                    ]
                ]
            ],
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agentfdrate.system',
                'remark' => 'agent_fd_mode=1',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdrate.system',
                    ],
                    [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdrate.post_system',
                    ]
                ]
            ],
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agentfdmoneylogs.index',
                'remark' => 'agent_fd_mode=1',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.agentfdmoneylogs.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylogs.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylogs.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylogs.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylogs.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylogs.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.agentfdmoneylogs.destroy',
                    ],[
                        'name' => '????????',
                        'route_name' => 'admin.agentfdmoneylog.handle_record'
                    ]
                ]
            ],
            [
                'name' => '??????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.agent.active_member',
                'child' => [
                    [
                        'name' => '????????????',
                        'route_name' => 'admin.agent.active_member',
                    ],
                    [
                        'name' => '????????????',
                        'route_name' => 'admin.agent.post_active_member',
                    ],
                ]
            ],
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonuses.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.dailybonuses.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.dailybonuses.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.dailybonuses.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.dailybonuses.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.dailybonuses.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.dailybonuses.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.dailybonuses.destroy',
                    ]
                ]
            ],
            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonus.setting_size',
                'child' => [
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.setting_size',
                    ],
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.post_setting_size',
                    ],
                ]
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonus.setting',
                'child' => [
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.setting',
                    ],
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.post_setting',
                    ]
                ]
            ],
            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonus.setting_desc',
                'child' => [
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.setting_desc',
                    ],
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.dailybonus.post_setting_desc',
                    ],
                ]
            ],
            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonus.get_redbag_log',
                'child' => [
                    [
                        'name' => '?????',
                        'route_name' => 'admin.dailybonus.get_redbag_log',
                    ],
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.dailybonuses.record_list',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.dailybonuses.record_list'
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.dailybonuses.modify_state'
                    ]
                ]
            ],

            [
                'name' => '?????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.yuebaoplans.index',
                //'is_open' => 0,
                'child' => [
                    [
                        'name' => '???????',
                        'route_name' => 'admin.yuebaoplans.index',
                        //'is_open' => 0,
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.yuebaoplans.create',
                        //'is_open' => 0,
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.yuebaoplans.show',
                        //'is_open' => 0,
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.yuebaoplans.store',
                        //'is_open' => 0,
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.yuebaoplans.edit',
                        //'is_open' => 0,
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.yuebaoplans.update',
                        //'is_open' => 0,
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.yuebaoplans.destroy',
                        //'is_open' => 0,
                    ]
                ]
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberyuebaoplans.index',
                //'is_open' => 0,
                'child' => [
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.memberyuebaoplans.index',
                        //'is_open' => 0,
                    ],
                    [
                        'name' => '?????????',
                        'route_name' => 'admin.memberyuebaoplans.interest_history',
                        //'is_open' => 0,
                    ]
                ]
            ],

//            [
//                'name' => '??????',
//                'pid' => null,
//                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
//                'route_name' => 'admin.creditpayrecord.borrow',
//                'is_open' => 0,
//                'child' => [
//                    [
//                        'name' => '??????',
//                        'route_name' => 'admin.creditpayrecord.confirm',
//                        'is_open' => 0,
//                    ],
//                    [
//                        'name' => '??????',
//                        'route_name' => 'admin.creditpayrecord.reject',
//                        'is_open' => 0,
//                    ]
//                ]
//            ],

//            [
//                'name' => '??????',
//                'pid' => null,
//                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
//                'route_name' => 'admin.creditpayrecord.lend',
//            ],

            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.activities.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.activities.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.activities.create',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.activities.show',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.activities.store',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.activities.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.activities.update',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.activities.destroy',
                    ]
                ]
            ],
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.activityapplies.index',
                'child' => [

                    [
                        'name' => '????????',
                        'route_name' => 'admin.activityapplies.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.activityapplies.confirm',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.activityapplies.post_confirm',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.activityapplies.bonus'
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.activityapplies.post_bonus'
                    ]

                ]
            ],

            /**
            [
            'name' => '????',
            'pid' => null,
            'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
            'route_name' => 'admin.tasks.index',
            'child' => [
            [
            'name' => '????',
            'route_name' => 'admin.tasks.index',
            ], [
            'name' => '??????',
            'route_name' => 'admin.tasks.create',
            ], [
            'name' => '??????',
            'route_name' => 'admin.tasks.show',
            ], [
            'name' => '??????',
            'route_name' => 'admin.tasks.store',
            ], [
            'name' => '??????',
            'route_name' => 'admin.tasks.edit',
            ], [
            'name' => '??????',
            'route_name' => 'admin.tasks.update',
            ], [
            'name' => '????',
            'route_name' => 'admin.tasks.destroy',
            ]
            ]
            ],
             **/

            /**
            [
            'name' => '??????',
            'pid' => null,
            'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
            'route_name' => 'admin.task.level_setting',
            'child' => [
            [
            'name' => '????????',
            'route_name' => 'admin.task.level_setting',
            ],
            [
            'name' => '??????????',
            'route_name' => 'admin.task.post_level_setting',
            ],
            [
            'name' => '????????',
            'route_name' => 'admin.task.delete_level_setting',
            ]
            ]
            ],
             **/

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.levelconfigs.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.levelconfigs.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.levelconfigs.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.levelconfigs.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.levelconfigs.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.levelconfigs.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.levelconfigs.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.levelconfigs.destroy',
                    ]
                ],
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberwheel.setting',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.memberwheel.setting',
                    ],
                    [
                        'name' => '????????',
                        'route_name' => 'admin.memberwheel.post_setting'
                    ]
                ]
            ],

            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberwheels.index',
                'child' => [
                    [
                        'name' => '??????????',
                        'route_name' => 'admin.memberwheels.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberwheels.show',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberwheels.destroy',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.memberwheel.ensure'
                    ]
                ]
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemnotices.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.systemnotices.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemnotices.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemnotices.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemnotices.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemnotices.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.systemnotices.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.systemnotices.destroy',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemconfigs.config_content',
                'child' => []
            ],

            [
                'name' => '?????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.banners.index',
                'child' => [
                    [
                        'name' => '?????',
                        'route_name' => 'admin.banners.index',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banners.create',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banners.show',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banners.store',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banners.edit',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.banners.update',
                    ], [
                        'name' => '?????',
                        'route_name' => 'admin.banners.destroy',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.abouts.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.abouts.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.abouts.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.abouts.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.abouts.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.abouts.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.abouts.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.abouts.destroy',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.sports.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.sports.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.sports.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.sports.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.sports.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.sports.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.sports.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.sports.destroy',
                    ]
                ]
            ],
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.quick.arbitrage_query',
            ],
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.quick.member_arbitrage_query',
            ],
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.quick.transfer_check',
                'child' => [

                    [
                        'name' => '??????',
                        'route_name' => 'admin.quick.transfer_check'
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.quick.add_transfer'
                    ]
                ]
            ],
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.quick.database_clean',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.quick.database_clean'
                    ],
                    [
                        'name' => '????????',
                        'route_name' => 'admin.quick.post_database_clean'
                    ]
                ]
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '?????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.users.index',
                'child' => [

                    // ????????? is_show ???0,icon??????
                    [
                        'name' => '?????',
                        'route_name' => 'admin.users.index',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.users.create',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.users.store',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.users.edit',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.users.update',
                    ], [
                        'name' => '?????',
                        'route_name' => 'admin.users.destroy',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.users.assign',
                    ], [
                        'name' => '?????????',
                        'route_name' => 'admin.users.post_assign',
                    ],[
                        'name' => '??????????',
                        'route_name' => 'admin.user.post_reset_google'
                    ]
                ]
            ],

            [
                'name' => '????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.roles.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.roles.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.roles.create',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.roles.store',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.roles.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.roles.update',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.roles.destroy',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.roles.assign',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.roles.post_assign',
                    ]
                ]
            ],
            [
                'name' => '????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.permissions.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.permissions.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.permissions.create',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.permissions.show',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.permissions.store',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.permissions.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.permissions.update',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.permissions.destroy',
                    ]
                ]
            ],

            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.attachments.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.attachments.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.attachments.show',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.attachments.destroy',
                    ]
                ]
            ],

            [
                'name' => '??IP??',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.blackips.index',
                'child' => [
                    [
                        'name' => '??IP??',
                        'route_name' => 'admin.blackips.index',
                    ], [
                        'name' => '????IP??',
                        'route_name' => 'admin.blackips.create',
                    ], [
                        'name' => '????IP??',
                        'route_name' => 'admin.blackips.show',
                    ], [
                        'name' => '????IP??',
                        'route_name' => 'admin.blackips.store',
                    ], [
                        'name' => '????IP??',
                        'route_name' => 'admin.blackips.edit',
                    ], [
                        'name' => '????IP??',
                        'route_name' => 'admin.blackips.update',
                    ], [
                        'name' => '????IP',
                        'route_name' => 'admin.blackips.destroy',
                    ]
                ]
            ],
        ],

    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.apis.index',
                'child' => [
                    [
                        'name' => '????',
                        'route_name' => 'admin.apis.index',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.apis.create',
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.apis.store',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.apis.edit',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.apis.update',
                    ], [
                        'name' => '????',
                        'route_name' => 'admin.apis.destroy',
                    ]
                ]
            ],
            [
                'name' => 'API????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.apigames.index',
                'child' => [
                    [
                        'name' => 'API????',
                        'route_name' => 'admin.apigames.index',
                    ], [
                        'name' => '??API????',
                        'route_name' => 'admin.apigames.create',
                    ],
                    [
                        'name' => '??API????',
                        'route_name' => 'admin.apigames.store',
                    ], [
                        'name' => '??API????',
                        'route_name' => 'admin.apigames.edit',
                    ], [
                        'name' => '??API????',
                        'route_name' => 'admin.apigames.update',
                    ], [
                        'name' => '??API??',
                        'route_name' => 'admin.apigames.destroy',
                    ]
                ]
            ],
            [
                'name' => 'API???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.gamehots.index',
                'child' => [
                    [
                        'name' => 'API???????',
                        'route_name' => 'admin.gamehots.index',
                    ], [
                        'name' => '??API?????',
                        'route_name' => 'admin.gamehots.create',
                    ],
                    [
                        'name' => '??API???????',
                        'route_name' => 'admin.gamehots.store',
                    ], [
                        'name' => '??API?????',
                        'route_name' => 'admin.gamehots.edit',
                    ], [
                        'name' => '??API???????',
                        'route_name' => 'admin.gamehots.update',
                    ], [
                        'name' => '??API?????',
                        'route_name' => 'admin.gamehots.destroy',
                    ]
                ]
            ],
            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.apigames.mobile_category',
                'child' => [
                    [
                        'name' => '??????????',
                        'route_name' => 'admin.apigames.mobile_category',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.apigames.mobile_category_save',
                    ]
                ]
            ],
            [
                'name' => '??/??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.gamelists.index',
                'child' => [
                    [
                        'name' => '??/??????',
                        'route_name' => 'admin.gamelists.index',
                    ], [
                        'name' => '????/??????',
                        'route_name' => 'admin.gamelists.create',
                    ],
                    [
                        'name' => '????/??????',
                        'route_name' => 'admin.gamelists.store',
                    ], [
                        'name' => '????/??????',
                        'route_name' => 'admin.gamelists.edit',
                    ], [
                        'name' => '????/??????',
                        'route_name' => 'admin.gamelists.update',
                    ], [
                        'name' => '????/????',
                        'route_name' => 'admin.gamelists.destroy',
                    ]
                ]
            ]
        ]
    ],

    // ????
    [
        'name' => '????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.adminlogs.index',
                'child' => [
                    /**
                    [
                    'name' => '??????',
                    'route_name' => 'admin.adminlogs.index',
                    ],
                     **/
                    [
                        'name' => '????????',
                        'route_name' => 'admin.adminlogs.show',
                    ],
                    [
                        'name' => '??????',
                        'route_name' => 'admin.adminlogs.destroy',
                    ]
                ]
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.adminlogs.type.login',
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.adminlogs.type.logout',
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.adminlogs.type.action',
            ],

            [
                'name' => '??????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.adminlogs.type.system',
            ],

            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.memberlogs.index',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.memberlogs.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.memberlogs.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.memberlogs.destroy',
                    ]
                ]
            ],

            [
                'name' => '????????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.membermoneylogs.index',
                'child' => [
                    [
                        'name' => '????????',
                        'route_name' => 'admin.membermoneylogs.index',
                    ], [
                        'name' => '??????????',
                        'route_name' => 'admin.membermoneylogs.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.membermoneylogs.destroy',
                    ]
                ]
            ],
        ]
    ],

    [
        'name' => '???',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '?????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.messages.index',
                'child' => [
                    [
                        'name' => '???????',
                        'route_name' => 'admin.messages.index',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.messages.create',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.messages.store',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.messages.show',
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.messages.edit'
                    ], [
                        'name' => '???????',
                        'route_name' => 'admin.messages.update'
                    ], [
                        'name' => '?????',
                        'route_name' => 'admin.messages.destroy',
                    ]
                ]
            ],

            [
                'name' => '???????',
                'pid' => null,
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.messages.index_member',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.messages.index_member'
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.messages.reply'
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.messages.post_reply'
                    ],
                    // [
                    //     'name' => '??????'
                    // ]
                ]
            ]
        ]
    ],

    /**
    [
    'name' => '????',
    'pid' => null,
    'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
    'child' => [

    ],
    ],
     **/

    [
        'name' => 'APP??',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => 'APP??',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemnotice.app',
                'child' => []
            ],

            [
                'name' => 'APP????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.systemconfigs.config_app_content',
                'child' => []
            ],

            [
                'name' => 'APP????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.activity.app_index',
                'child' => []
            ]
        ]
    ],

    [
        'name' => '?????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'child' => [
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.quickurls.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.quickurls.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.quickurls.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.quickurls.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.quickurls.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.quickurls.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.quickurls.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.quickurls.destroy',
                    ]
                ]
            ],

            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.asideadvs.index',
                'child' => [
                    [
                        'name' => '??????',
                        'route_name' => 'admin.asideadvs.index',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.asideadvs.create',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.asideadvs.show',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.asideadvs.store',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.asideadvs.edit',
                    ], [
                        'name' => '????????',
                        'route_name' => 'admin.asideadvs.update',
                    ], [
                        'name' => '??????',
                        'route_name' => 'admin.asideadvs.destroy',
                    ]
                ]
            ],
        ],
    ],

    [
        'name' => '??????',
        'pid' => null,
        'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
        'is_show' => 'false',
        'child' => [
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.notice',
                'child' => []
            ],
            [
                'name' => '??????',
                'icon' => 'mdi mdi-checkbox-multiple-blank-circle-outline',
                'route_name' => 'admin.fix.url',
            ]
        ]
    ]
];
