<?php

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'test01',
                'password' => '123456'
            ],
            [
                'name' => 'test02',
                'password' => '123456'
            ],
            [
                'id' => 7,
                'name' => 'haha01',
                'password' => '123456'
            ]
        ];

        foreach($data as $item){
            Member::create($item);
        }

        //Member::insert($data);
        
        $memberapis = [
            ['member_id' => '1','username' => 'ac5test01','password' => '208d643492','api_name' => 'BBIN',],
            ['member_id' => '1','username' => 'ac5test01','password' => '208d643492','api_name' => 'AG',],
            ['member_id' => '1','username' => 'ac5test01','password' => '208d643492','api_name' => 'MG',],
            ['member_id' => '2','username' => 'ac5test02','password' => '53fff85561','api_name' => 'BBIN',],
            ['member_id' => '2','username' => 'ac5test02','password' => '53fff85561','api_name' => 'AG',],
            ['member_id' => '2','username' => 'ac5test02','password' => '53fff85561','api_name' => 'MG',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'IG',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'AG',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'NEWBBIN',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'JDB',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'AB',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'OG',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'SS',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'VR',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'KY',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'IMSPORT',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'SABA',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'MT',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'BG',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'FASTBET',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'CQ9',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'PT',],
            ['member_id' => '7','username' => '1iahaha01','password' => 'ba581130a8','api_name' => 'IMSLOT',],


        ];

        foreach ($memberapis as $item) {
            \App\Models\MemberApi::create($item);
        }
    }
}
