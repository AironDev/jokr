<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();

        Bouncer::role()->create([
            'name' => 'sudo',
            'title' => 'Sudo',
            'description' =>
                'This guy is on god mode, avoid him',
        ]);
        Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrator',
            'description' =>
                'Somebody who has access to all the administration features within a single site.',
        ]);
        Bouncer::role()->create([
            'name' => 'author',
            'title' => 'Author',
            'description' =>
                'Can setup games (quizes, puzzles, etc)',
        ]);
        Bouncer::role()->create([
            'name' => 'moderator',
            'title' => 'Moderator',
            'description' =>
                'Can manage games (set status to active or inactive, flag offensive comments)',
        ]);
        Bouncer::role()->create([
            'name' => 'editor',
            'title' => 'Editor',
            'description' =>
                'Can perform CRU-D operations (but cannot not delete)',
        ]);
        
        Bouncer::role()->create([
            'name' => 'user',
            'title' => 'User',
            'description' => 
                'Somebody who can only manage their profile.',
        ]);

        Bouncer::role()->create([
            'name' => 'guest',
            'title' => 'Guest',
            'description' => 
                'This guy does not know what is happening, right?',
        ]);
    }
}
