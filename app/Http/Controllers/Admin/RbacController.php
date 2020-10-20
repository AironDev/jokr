<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use Silber\Bouncer\Bouncer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RbacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    {
        $roles = Bouncer::role()->all();
        return $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAbilities()
    {
        $abilities = Bouncer::ability()->all();
        return $abilities;
    }

    /**
     * Show the form for creating a new resource (roles and abilities).
     *
     * @return \Illuminate\Http\Response
     */
    public function createRolesAndAbilities()
    {
        return view('admin.rbac.create');
    }

    /**
     * store a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string',
            'role_title' => 'required|string',
            'role_description' => 'required|string',
        ]);

        $validator->validate();

        $role = Bouncer::role()->updateOrCreate([
            'name' => $request->role_name, //match only the name attribute while creating
        ]);

        $role->update([
            'title' => $request->role_title,
            'description' => $request->role_description,
        ]);

        return $role;
    }

    /**
     * store a new ability.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAbility(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ability_name' => 'required|string',
            'ability_title' => 'required|string',
            'ability_description' => 'required|string',
        ]);

        $validator->validate();

        $ability = Bouncer::ability()->updateOrCreate([
            'name' => $request->ability_name, //match only the name attribute while creating
        ]);

        $ability->update([
            'title' => $request->ability_title,
            'description' => $request->ability_description,
        ]);

        return $ability;
    }

    /**
     * show form to attach ability to role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachAbility(CreateRoleAndAbilityRequest $request)
    {
        return view('admin.rbac.attach');
    }


    /**
     * attach role and ability to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachAbilityToRole(CreateRoleAndAbilityRequest $request)
    {
        $role = Bouncer::role()->firstOrCreate([
            'name' => $request->role_name,
        ]);

        $ability = Bouncer::ability()->firstOrCreate([
            'name' => $request->ability_name,
        ]);

        Bouncer::allow($role)->to($ability);
    }


    /**
     * show form to assign role to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignRole(CreateRoleAndAbilityRequest $request)
    {
        return view('admin.rbac.assign');
    }


    /**
     * assign role to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignRoleToUser(CreateRoleAndAbilityRequest $request)
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
