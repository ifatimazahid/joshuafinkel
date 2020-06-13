<?php

namespace App\Repositories\Admin;

use App\Models\Membership;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories\Admin
 * @version May 23, 2020, 8:17 pm UTC
 *
 * @method Question findWithoutFail($id, $columns = ['*'])
 * @method Question find($id, $columns = ['*'])
 * @method Question first($columns = ['*'])
*/
class MembershipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'email',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Membership::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $membership = $this->create($input);
        return $membership;
    }

    /**
     * @param $request
     * @param $question
     * @return mixed
     */
    public function updateRecord($request, $membership)
    {
        $input = $request->all();
        $membership = $this->update($input, $membership->id);
        return $membership;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $membership = $this->delete($id);
        return $membership;
    }
}
