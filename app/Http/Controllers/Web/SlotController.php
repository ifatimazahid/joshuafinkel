<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SlotBookings;
use App\Repositories\Admin\MembershipRepository;
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

    public function __construct(SlotRepository $slotRepo, SlotDetailsRepository $slotDetailsRepo)
    {
//        $this->middleware('auth');
        $this->slotRepository = $slotRepo;
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
        $slots = $this->slotRepository->all();
        return view('pages.table')->with([
            'slots' => $slots
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

    public function book(Request $request)
    {
//        dd($request->id);
        $user = Auth::id();

        if ($user) {
            $slot = [];
            $slot['user_id'] = $user;
            $slot['slot_id'] = $request->id;

            SlotBookings::create($slot);

            return view('pages.success');
        } else{
            return redirect(route('register'))->with([
                'id' => $request->id
            ]);
        }
    }
    public function success(){
        return view('pages.success');
    }
}