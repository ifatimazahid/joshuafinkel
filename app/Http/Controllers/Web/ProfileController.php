<?php

namespace App\Http\Controllers\Web;

use App\Helper\BreadcrumbsRegister;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MembershipRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\SlotBookingRepository;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

/**
 * Class ContactUsController
 * @package App\Http\Controllers\Web
 */
class ProfileController extends Controller
{
    private $slotRepository;

    private $slotBookingRepository;

    public function __construct(SlotRepository $slotRepo, SlotBookingRepository $slotBookingRepo)
    {
        $this->middleware('auth');
        $this->slotRepository = $slotRepo;
        $this->slotBookingRepository = $slotBookingRepo;
    }

    /**
     * Display a listing of the ContactUs.
     *
     * @param ContactUsDataTable $contactUsDataTable
     * @return Response
     */
    public function index()
    {
        $user = Auth::id();
        $booked = $this->slotBookingRepository->findWhere(['status' => 2, 'user_id' => $user]);

        if(count($booked) <= 0){
            return view('pages.profile');
        } else {
            foreach ($booked as $item){
                $slots = $this->slotRepository->findWhere(['id' => $item->slot_id]);

            }
            return view('pages.profile')->with([
                'slots' => $slots
            ]);
        }
    }
}