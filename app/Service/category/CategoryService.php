<?php
/**
 * Created by PhpStorm.
 * User: aminur
 * Date: 9/8/21
 * Time: 9:02 PM
 */

namespace App\Service\category;


use App\Category;
use Illuminate\Support\Str;

class CategoryService implements CategoryServiceInterface
{
    public function all()
    {
        // TODO: Implement all() method.

        $category = Category::latest()->get();

        return $category;
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.

        Category::insert($data);
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.

        $category = Category::findOrFail($id);

        return $category;
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.

        Category::insert($data);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.

        Category::destroy($id);
    }
}