<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'name' => 'sudo',
            'description' =>
                'This guy is on god mode, avoid him',
        ]);
        Role::create([
            'name' => 'admin',h
            'description' =>
                'somebody who has access to all the administration features within a single site.',
        ]);
        Role::create([
            'name' => 'author',
            'description' =>
                'can setup games (quizes, puzzles, etc)',
        ]);
        Role::create([
            'name' => 'moderator',
            'description' =>
                'can manage games (set status to active or inactive, flag offensive comments)',
        ]);
        Role::create([
            'name' => 'editor',
            'description' =>
                'can perform CRU-D operations (but cannot not delete)',
        ]);
        
        Role::create([
            'name' => 'user',
            'description' => 
                'somebody who can only manage their profile.',
        ]);
    }
}
