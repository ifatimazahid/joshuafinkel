<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\SlotDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSlotRequest;
use App\Http\Requests\Admin\UpdateSlotRequest;
use App\Models\ProductSlots;
use App\Models\SlotDetails;
use App\Repositories\Admin\SlotRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class SlotController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  SlotRepository */
    private $slotRepository;

    public function __construct(SlotRepository $slotRepo)
    {
        $this->slotRepository = $slotRepo;
        $this->ModelName = 'slots';
        $this->BreadCrumbName = 'Slots';
    }

    /**
     * Display a listing of the Slot.
     *
     * @param SlotDataTable $slotDataTable
     * @return Response
     */
    public function index(SlotDataTable $slotDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $slotDataTable->render('admin.slots.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Slot.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.slots.create')->with(['title' => $this->BreadCrumbName,
//                                                 'product_id' => $request->get('product_id')
        ]);
    }

    /**
     * Store a newly created Slot in storage.
     *
     * @param CreateSlotRequest $request
     *
     * @return Response
     */
    public function store(CreateSlotRequest $request)
    {
        $slot = $this->slotRepository->saveRecord($request);

        $var['slot_id'] = $slot->id;
        $var['date'] = $request['date'];
        $var['time'] = $request['time'];
        $var['description'] = $request['description'];
        $var['price'] = $request['price'];

        SlotDetails::create($var);

//        $value = [];
//        $value['slot_id'] = $slot->id;
//        $value['product_id'] = $request->product_id;
//        ProductSlots::create($value);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.slots.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.slots.edit', $slot->id));
        } else {
            $redirect_to = redirect(route('admin.slots.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Slot.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.slots.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $slot);
        return view('admin.slots.show')->with(['slot' => $slot, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Slot.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.slots.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $slot);
        return view('admin.slots.edit')->with(['slot' => $slot, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified Slot in storage.
     *
     * @param  int              $id
     * @param UpdateSlotRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSlotRequest $request)
    {
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.slots.index'));
        }

        $slot = $this->slotRepository->updateRecord($request, $slot);

        $var['date'] = $request['date'];
        $var['time'] = $request['time'];
        $var['description'] = $request['description'];
        $var['price'] = $request['price'];

        SlotDetails::where('slot_id', $id)->update($var);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.slots.create'));
        } else {
            $redirect_to = redirect(route('admin.slots.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Slot from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.slots.index'));
        }

        $this->slotRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.slots.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
