<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Models\SlotBookings;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\ProductDetailsRepository;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\SlotBookingRepository;
use App\Repositories\Admin\SlotDetailsRepository;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ContactUsController
 * @package App\Http\Controllers\Web
 */
class ProductController extends Controller
{
    private $productRepository;

    private $slotRepository;

    private $slotBookingRepository;

    private $slotDetailsRepository;

    public function __construct(ProductRepository $productRepo, SlotRepository $slotRepo, SlotBookingRepository $slotBookingRepo, SlotDetailsRepository $slotDetailsRepo)
    {
//        $this->middleware('auth');
        $this->slotRepository = $slotRepo;
        $this->productRepository = $productRepo;
        $this->slotBookingRepository = $slotBookingRepo;
        $this->slotDetailsRepository = $slotDetailsRepo;
    }

    /**
     * Display a listing of the ContactUs.
     *
     * @param ContactUsDataTable $contactUsDataTable
     * @return Response
     */
    public function index()
    {
        $products = $this->productRepository->all();

        $user = Auth::id();

        if (isset($user)) {

            $booked = $this->slotBookingRepository->findWhereNotIn('status', [1]);

            foreach ($booked as $value){
                $slots = $this->slotRepository->findWhere(['id' => $value->slot_id]);
            }
            if (count($booked) <= 0){

                return view('pages.products')
                    ->with([
                        'user' => $user,
                        'products' => $products
                    ]);
            } else{
                return view('pages.products')
                    ->with([
                        'user' => $user,
                        'products' => $products,
                        'slots'   => $slots
                    ]);
            }
        } else{
            return view('pages.products')
                ->with([
                    'products' => $products
                ]);
        }
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
}