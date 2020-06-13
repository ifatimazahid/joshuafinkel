<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSlotAPIRequest;
use App\Http\Requests\Api\UpdateSlotAPIRequest;
use App\Models\Slot;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class SlotController
 * @package App\Http\Controllers\Api
 */

class SlotAPIController extends AppBaseController
{
    /** @var  SlotRepository */
    private $slotRepository;

    public function __construct(SlotRepository $slotRepo)
    {
        $this->slotRepository = $slotRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/slots",
     *      summary="Get a listing of the Slots.",
     *      tags={"Slot"},
     *      description="Get all Slots",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="orderBy",
     *          description="Pass the property name you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="sortedBy",
     *          description="Pass 'asc' or 'desc' to define the sorting method. If not found, 'asc' will be used by default",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="limit",
     *          description="Change the Default Record Count. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="offset",
     *          description="Change the Default Offset of the Query. If not found, 0 will be used.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Slot")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->slotRepository->pushCriteria(new RequestCriteria($request));
        $this->slotRepository->pushCriteria(new LimitOffsetCriteria($request));
        $slots = $this->slotRepository->all();

        return $this->sendResponse($slots->toArray(), 'Slots retrieved successfully');
    }

    /**
     * @param CreateSlotAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/slots",
     *      summary="Store a newly created Slot in storage",
     *      tags={"Slot"},
     *      description="Store Slot",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Slot that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Slot")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Slot"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSlotAPIRequest $request)
    {
        $slots = $this->slotRepository->saveRecord($request);

        return $this->sendResponse($slots->toArray(), 'Slot saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/slots/{id}",
     *      summary="Display the specified Slot",
     *      tags={"Slot"},
     *      description="Get Slot",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Slot"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Slot $slot */
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        return $this->sendResponse($slot->toArray(), 'Slot retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSlotAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/slots/{id}",
     *      summary="Update the specified Slot in storage",
     *      tags={"Slot"},
     *      description="Update Slot",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Slot that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Slot")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Slot"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSlotAPIRequest $request)
    {
        /** @var Slot $slot */
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        $slot = $this->slotRepository->updateRecord($request, $id);

        return $this->sendResponse($slot->toArray(), 'Slot updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/slots/{id}",
     *      summary="Remove the specified Slot from storage",
     *      tags={"Slot"},
     *      description="Delete Slot",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Slot $slot */
        $slot = $this->slotRepository->findWithoutFail($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        $this->slotRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Slot deleted successfully');
    }
}
