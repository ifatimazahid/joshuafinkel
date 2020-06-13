<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories\Admin
 * @version June 6, 2020, 10:02 am UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
*/
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $product = $this->create($input);
        return $product;
    }

    /**
     * @param $request
     * @param $product
     * @return mixed
     */
    public function updateRecord($request, $product)
    {
        $input = $request->all();
        $product = $this->update($input, $product->id);
        return $product;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $product = $this->delete($id);
        return $product;
    }
}
