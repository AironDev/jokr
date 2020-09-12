<?php
namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

interface PostRepositoryInterface {
    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll();

    // /**
    //  * @param Request $request
    //  * @return mixed
    //  */
    // public function create(Request $request);

    // /**
    //  * @param Request $request
    //  * @return mixed
    //  */
    // public function store(Request $request);

    // /**
    //  * @param $id
    //  * @return mixed
    //  */
    // public function show($id);

    // /**
    //  * @param Request $request
    //  * @return mixed
    //  */
    // public function edit($id);

    // /**
    //  * @param $id
    //  * @return mixed
    //  */
    // public function destroy($id);

    // /**
    //  * @param Request $request
    //  * @param $id
    //  * @return mixed
    //  */
    // public function update(Request $request, $id);
}
