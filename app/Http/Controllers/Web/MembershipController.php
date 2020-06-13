<?php

namespace App\Http\Controllers\Web;

use App\Helper\BreadcrumbsRegister;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MembershipRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

/**
 * Class ContactUsController
 * @package App\Http\Controllers\Web
 */
class MembershipController extends Controller
{
    private $membershipRepository;

    public function __construct(MembershipRepository $membershipRepo)
    {
//        $this->middleware('auth');
        $this->membershipRepository = $membershipRepo;
    }

    /**
     * Display a listing of the ContactUs.
     *
     * @param ContactUsDataTable $contactUsDataTable
     * @return Response
     */
    public function index()
    {
        return view('pages.membership');
    }

    public function create(Request $request)
    {
        dd($request);
        $this->membershipRepository->saveRecord($request);
//        return redirect(route('pages.home'));
    }
}