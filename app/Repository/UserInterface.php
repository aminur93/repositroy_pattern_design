<?php
/**
 * Created by PhpStorm.
 * User: aminur
 * Date: 8/24/21
 * Time: 5:38 PM
 */

namespace App\Repository;

interface UserInterface{

    public function all();

    public function store(array $data);

    public function edit($id);

    public function update(array $data, $id);

    public function destroy($id);
}