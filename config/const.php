<?php

return [
    'API_PAGINATE' => 15,
    'ERROR_CODE' => [
        'NO_ERROR' => 0,
        'MEMBER_NOT_EXIST' => 1,
        'INVALID_IP' => 2,
        'USERNAME_EMPTY' => 3,
        'COMPANY_KEY_ERROR' => 4,
        'NOT_ENOUGH_BALANCE' => 5,
        'BET_NOT_EXIST' => 6,
        'INTERNAL_ERROR' => 7,
        'BET_ALREADY_SETTLED' => 2001,
        'BET_ALREADY_CANCELED' => 2002,
        'BET_ALREADY_ROLLBACK' => 2003,
        'BET_REFNO_EXIST' => 5003,
        'BET_ALREADY_RETURNED_STAKE' => 5008,
    ],
    'PRODUCT_TYPE' => [
        'SPORT_BOOK' => 1,
        'SBO_GAME' => 3,
        'VIRTUAL_SPORTS' => 5,
        'SBO_LIVE_CASINO' => 7,
        'SEAMLESS_GAME_PROVIDER' => 9,
        'LIVE_COIN' => 10,
    ],
];
