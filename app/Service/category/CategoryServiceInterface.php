<?php

namespace App\Service\category;

interface CategoryServiceInterface{

    public function all();

    public function store(array $data);

    public function edit($id);

    public function update(array $data, $id);

    public function destroy($id);
}