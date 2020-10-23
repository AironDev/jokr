<?php

use Illuminate\Database\Seeder;
use App\Helpers\Util;
use Silber\Bouncer\BouncerFacade as Bouncer;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('abilities')->truncate();

        $models =  Util::getModels();
        foreach ($models as $model) {
        	Bouncer::ability()->create([
	            'name' => 'create' . $model,
	            'title' => 'Can Create' . $model,
	            'description' =>
	                'Allows create operations on ' . $model,
        	]);

        	Bouncer::ability()->create([
	            'name' => 'read' . $model,
	            'title' => 'Can Read' . $model,
	            'description' =>
	                'Allows read operations on ' . $model,
        	]);

        	Bouncer::ability()->create([
	            'name' => 'update' . $model,
	            'title' => 'Can Update' . $model,
	            'description' =>
	                'Allows update operations on ' . $model,
        	]);

        	Bouncer::ability()->create([
	            'name' => 'delete' . $model,
	            'title' => 'Can Delete' . $model,
	            'description' =>
	                'Allows delete operations on ' . $model,
        	]);
        }
    }
}
