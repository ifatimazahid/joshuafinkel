<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SlotBookings;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\ProductDetailsRepository;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\SlotDetailsRepository;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class ContactUsController
 * @package App\Http\Controllers\Web
 */
class ProductController extends Controller
{
    private $productRepository;

    private $slotRepository;

    public function __construct(ProductRepository $productRepo, SlotRepository $slotRepo)
    {
//        $this->middleware('auth');
        $this->slotRepository = $slotRepo;
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the ContactUs.
     *
     * @param ContactUsDataTable $contactUsDataTable
     * @return Response
     */
    public function index()
    {
        $slots = $this->slotRepository->all();
        $products = $this->productRepository->all();
        return view('pages.products')
            ->with([
            'slots' => $slots,
                'products' => $products
        ]);
    }


    public function slot_details($id)
    {
        $details = $this->slotDetailsRepository->findWhere(['slot_id' => $id]);
//        dd($details);
        return view('pages.products')->with([
            'id' => $id,
            'details' => $details
        ]);
    }

    public function create(Request $request)
    {
        dd($request);
        $this->membershipRepository->saveRecord($request);
//        return redirect(route('pages.home'));
    }
}