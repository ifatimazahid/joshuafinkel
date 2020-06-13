<?php

namespace App\Repositories\Admin;

use App\Models\Company;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CompanyRepository
 * @package App\Repositories\Admin
 * @version December 26, 2019, 12:13 pm UTC
 *
 * @method Company findWithoutFail($id, $columns = ['*'])
 * @method Company find($id, $columns = ['*'])
 * @method Company first($columns = ['*'])
*/
class CompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'location'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Company::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $company = $this->create($input);
        return $company;
    }

    /**
     * @param $request
     * @param $company
     * @return mixed
     */
    public function updateRecord($request, $company)
    {
        $input = $request->all();
        $company = $this->update($input, $company->id);
        return $company;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $company = $this->delete($id);
        return $company;
    }
}
