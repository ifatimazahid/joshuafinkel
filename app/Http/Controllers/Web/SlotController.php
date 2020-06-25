<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SlotBookings;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\SlotBookingRepository;
use App\Repositories\Admin\SlotDetailsRepository;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class ContactUsController
 * @package App\Http\Controllers\Web
 */
class SlotController extends Controller
{
    private $slotRepository;

    private $slotDetailsRepository;

    private $slotBookingRepository;

    public function __construct(SlotRepository $slotRepo, SlotDetailsRepository $slotDetailsRepo, SlotBookingRepository $slotBookingRepo)
    {
//        $this->middleware('auth');
        $this->slotRepository = $slotRepo;
        $this->slotDetailsRepository = $slotDetailsRepo;
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
        $slots = $this->slotRepository->all();
        return view('pages.table')->with([
            'slots' => $slots
        ]);
    }

    public function cancel(Request $request){
        $user = Auth::id();

        if (isset($request->id)){
            $booking = $this->slotBookingRepository->findWhere(['slot_id' => $request->id, 'user_id' => $user, 'status' => 2]);

            if ($booking){
                $var = [];
                $var['status'] = 1;
               SlotBookings::where('slot_id', '=', $request->id)->where('user_id', '=', $user)->update($var);
                return view('pages.success');
            }
            else {
                return view('pages.products');
            }
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

    public function create(Request $request)
    {
        dd($request);
        $this->membershipRepository->saveRecord($request);
//        return redirect(route('pages.home'));
    }

    public function book(Request $request)
    {
        $user = Auth::id();

        if (isset($user)) {

            $slot = $this->slotBookingRepository->findWhere(['slot_id' => $request->id, 'user_id' => $user, 'status' => 2]);
            if (count($slot) > 0){
                return 3;
            }

                $slot = [];
                $slot['user_id'] = $user;
                $slot['slot_id'] = $request->id;
                $slot['status'] = 2;

                SlotBookings::create($slot);

                return 1;
            }
             return 2;
    }
//    public function success(){
//        return view('pages.success');
//    }
}