<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use Silber\Bouncer\Bouncer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Helpers\Util;




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

    public function getSingleRole($name)
    {
        $role = Bouncer::role()->where('name', $name)->first();
        return view('admin.rbac.role')->with(['role' => $role]);
        //return $roles;
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
    public function rbac()
    {
        $roles = Bouncer::role()->all();
        $abilities = Bouncer::ability()->paginate(10);
        return view('admin.rbac.index')->with(['roles' => $roles, 'abilities' => $abilities]);
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

        
        if($request->header('Accept') == 'application/json'){
            return response()->json(['status' => 'created', 'message' => 'Role created successfully' ], 201);
        }else{
            return redirect()->back()->with('status', 'Role created successfully');
        }
    }

    /**
     * store a new ability.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAbility(Request $request)
    {
        try {
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

            //return $ability;
             return redirect()->back()->with('status', 'Ability created successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
    public function attachAbilityToRole(Request $request)
    {
        $validator = Validator::make($request->only('role', 'ability'), [
                        'role' => 'required|string',
                        'ability' => 'required|string'
                    ]);
        $validator->validate();
        try {
            $role = Bouncer::role()->firstOrCreate([
                'name' => $request->role
            ]);

            $ability =  Bouncer::ability()->firstOrCreate([
                    'name' => $request->ability
                ]);

            Bouncer::allow($role)->to($ability);

            if($request->header('Accept') == 'application/json'){
                return response()->json(['status' => 'created', 'message' => 'Role attached successfully' ], 201);
            }else{
                return redirect()->back()->with('status', 'Ability attached successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * assign role to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignUserRole(Request $request)
    {
        try {
            $role = Bouncer::role()->where('name', $request->role_name)->first();
            $user = User::find($request->user_id);
            Bouncer::assign($role)->to($user);
            return $user->getRoles();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }

    /**
     * retract role from user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function retractUserRole(Request $request)
    {
        try {
            $role = Bouncer::role()->where('name', $request->role_name)->first();
            $user = User::find($request->user_id);
            //Bouncer::retract($role)->from($user);
            return $role;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all user roles.
     *
     * @param  params  $userId
     * @return \Illuminate\Http\Response
     */
    public function getUserRoles(Request $request)
    {
        try {
            $user = User::find($request->userId);
            $roles = $user->getRoles();
            return response()->json($roles);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all user abilities.
     *
     * @param  params  $userId
     * @return \Illuminate\Http\Response
     */
    public function getUserAbilities(Request $request)
    {
        try {
            $user = User::find($request->userId);
            $roles = $user->getAbilities();
            return response()->json($roles);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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

    public function getModels()
    {
        return Util::getModels();
    }
}
