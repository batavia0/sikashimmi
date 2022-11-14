<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\anggota;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         
        $users = [
        ['username'         => 'admin',
            'name'          => 'Administrator',
            'id_jabatan'    => '1',
            'nim'           => '11111111',
            'password'      => Hash::make('admin'),
        ],
            ['username'     => 'alamanda',
            'name'          => 'Alamanda Yuniar',
            'id_jabatan'    => '2',
            'nim'           => '10107004',
            'password'      => Hash::make('anggota'),
        ],
        ['username'         => 'adi',
            'name'          => 'Adi Sudrajat',
            'id_jabatan'    => '2',
            'nim'           => '10107002',
            'password'      => Hash::make('anggota'),
        ],
        ['username'         => 'pengkuh',
            'name'          => 'Pengkuh Ranggga',
            'id_jabatan'    => '2',
            'nim'           => '10107044',
            'password'      => Hash::make('anggota'),
        ]
        ];
        foreach($users as $user){
            User::create($user);
        }
        $anggota = [
            [   
                'name'      => 'Administrator',
                'nim'       => '11111111',
                'email'     => 'admin@student.polsub.ac.id',
                'no_telepon'=> '085881769501'
                
            ],
            [
                'name'      => 'Alamanda Yuniar',
                'nim'       => '10107004',
                'email'     => 'alamanda@student.polsub.ac.id',
                'no_telepon'=> '085881769502'
            ],
            [   
                'name'      => 'Adi Sudrajat',
                'nim'       => '10107002',
                'email'     => 'adi@student.polsub.ac.id',
                'no_telepon'=> '085881769503'
            ],
            [   
                'name'      => 'Pengkuh Ranggga',
                'nim'       => '10107044',
                'email'     => 'pengkuh@student.polsub.ac.id',
                'no_telepon'=> '085881769504'
            ]
            ];
            foreach($anggota as $ag){
                anggota::create($ag);
            }
    }
}
