<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;
use App\User;
use App\Http\Controllers\Controller;

class RbacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAbilities()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRolesAndAbilities()
    {
        return view('admin.rbac.create');

    }

    /**
     * Store a newly created roles and ability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoleAndAbility(CreateRoleAndAbilityRequest $request)
    {
        $role = Bouncer::role()->firstOrCreate([
            'name' => $request->role_name,
            'title' => $request->role_title,
            'description' => $request->role_description,
        ]);

        $ability = Bouncer::ability()->firstOrCreate([
            'name' => $request->ability_name,
            'title' => $request->ability_title,
            'description' => $request->ability_description,
        ]);

        Bouncer::allow($role)->to($ability);
    }

    /**
     * Store a new and ability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAbility(Request $request)
    {
        //
    }

     /**
     * Store a new and ability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRole(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
