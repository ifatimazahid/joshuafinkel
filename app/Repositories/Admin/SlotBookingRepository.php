<?php

namespace App\Repositories\Admin;

use App\Models\Slot;
use App\Models\SlotBookings;
use App\Models\SlotDetails;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SlotRepository
 * @package App\Repositories\Admin
 * @version June 5, 2020, 6:55 am UTC
 *
 * @method Slot findWithoutFail($id, $columns = ['*'])
 * @method Slot find($id, $columns = ['*'])
 * @method Slot first($columns = ['*'])
*/
class SlotBookingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'slot_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SlotBookings::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $slot = $this->create($input);
        return $slot;
    }

    /**
     * @param $request
     * @param $slot
     * @return mixed
     */
    public function updateRecord($request, $slot)
    {
        $input = $request->all();
        $slot = $this->update($input, $slot->id);
        return $slot;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $slot = $this->delete($id);
        return $slot;
    }
}
