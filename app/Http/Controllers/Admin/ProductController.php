<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SlotDataTable;
use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\ProductDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\ProductDetails;
use App\Models\Slot;
use App\Models\SlotBookings;
use App\Repositories\Admin\ProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class ProductController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
        $this->ModelName = 'products';
        $this->BreadCrumbName = 'Products';
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $productDataTable->render('admin.products.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.products.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->saveRecord($request);

        $details = [];
        $details['product_id'] = $product->id;
        $details['description'] = $request->description;
        $details['price'] = $request->price;
        ProductDetails::create($details);

        $slot = [];
        $slot['product_id'] = $product->id;
        $slot['title'] = 'Slot 1';
        $done = Slot::create($slot);

        $slotBooking = [];
        $slotBooking['slot_id'] = $done->id;
        $slotBooking['user_id'] = Auth::id();
        $slotBooking['status'] = 1;
        SlotBookings::create($slotBooking);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.products.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.products.edit', $product->id));
        } else {
            $redirect_to = redirect(route('admin.products.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id, SlotDataTable $slotDataTable)
    {
        $product = $this->productRepository->findWithoutFail($id);
        $slotDataTable->product_id = $id;

        if (empty($product)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.products.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $product);
        return $slotDataTable->render('admin.products.show', [
            'product' => $product,
            'title'  => $this->BreadCrumbName
        ]);
//        return view('admin.products.show')->with(['product' => $product, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.products.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $product);
        return view('admin.products.edit')->with(['product' => $product, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.products.index'));
        }

        $product = $this->productRepository->updateRecord($request, $product);

        $details = [];
        $details['description'] = $request->description;
        $details['price'] = $request->price;
        ProductDetails::where('product_id', $id)->update($details);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.products.create'));
        } else {
            $redirect_to = redirect(route('admin.products.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.products.index'));
        }

        $this->productRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.products.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
