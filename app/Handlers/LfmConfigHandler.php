<?php

namespace App\Handlers;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return parent::userField();
        // $role = function_to_get_role();

	    // if($role == 'Admin'){
	    //     return 'folder_1';
	    // }else{
	    //     return 'folder_1/' . auth()->user()->name;          
	    // }
    
    }
}
