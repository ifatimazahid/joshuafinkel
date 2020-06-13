<?php

namespace App\Repositories\Admin;

use App\Models\ProductDetails;
use App\Models\Slot;
use App\Models\SlotDetails;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SlotRepositoryweb
 * @package App\Repositories\Admin
 * @version June 5, 2020, 6:55 am UTC
 *
 * @method Slot findWithoutFail($id, $columns = ['*'])
 * @method Slot find($id, $columns = ['*'])
 * @method Slot first($columns = ['*'])
*/
class ProductDetailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'description',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductDetails::class;
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
     * @param $slot
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
