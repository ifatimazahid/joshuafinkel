<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\CompanyDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Repositories\Admin\CompanyRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class CompanyController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
        $this->ModelName = 'companies';
        $this->BreadCrumbName = 'Companies';
    }

    /**
     * Display a listing of the Company.
     *
     * @param CompanyDataTable $companyDataTable
     * @return Response
     */
    public function index(CompanyDataTable $companyDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $companyDataTable->render('admin.companies.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Company.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.companies.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param CreateCompanyRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $company = $this->companyRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.companies.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.companies.edit', $company->id));
        } else {
            $redirect_to = redirect(route('admin.companies.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $company = $this->companyRepository->findWithoutFail($id);

        if (empty($company)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.companies.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $company);
        return view('admin.companies.show')->with(['company' => $company, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $company = $this->companyRepository->findWithoutFail($id);

        if (empty($company)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.companies.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $company);
        return view('admin.companies.edit')->with(['company' => $company, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified Company in storage.
     *
     * @param  int              $id
     * @param UpdateCompanyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyRequest $request)
    {
        $company = $this->companyRepository->findWithoutFail($id);

        if (empty($company)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.companies.index'));
        }

        $company = $this->companyRepository->updateRecord($request, $company);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.companies.create'));
        } else {
            $redirect_to = redirect(route('admin.companies.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $company = $this->companyRepository->findWithoutFail($id);

        if (empty($company)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.companies.index'));
        }

        $this->companyRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.companies.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
