<?php
namespace App\Http\Controllers;

use App\Models\OtherWork;
use App\Models\OtherWorkFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Exports\OtherWorksExport;


class OtherWorkManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:otherwork-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otherworks = OtherWork::paginate(10);
        return view('otherworks-management.index', compact('otherworks'));
    }

    public function reportUser()
    {
        $users = User::paginate(10);
        return view('otherworks-management.report.user', compact('users'));
    }

    public function search(Request $request)
    {
        if ($request->search != '') {
            $search_results = OtherWork::FullTextSearch('name', $request->search)->limit(5)->get();
            return view('otherworks-management.search', compact('search_results'));
        }
    }
}
