<?php
namespace App\Http\Controllers;

use App\Exports\OtherWorksAllExport;
use App\Helpers\General\CollectionHelper;
use App\Models\OtherWork;
use App\Models\User;
use Illuminate\Http\Request;

use App\Exports\OtherWorksExport;
use Spatie\Permission\Models\Role;


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

    public function reportUser(Request $request)
    {
        $department = $request->input('department', null);

        //dd(Role::findById($department)->users());

        if ($department == null)
            $users = User::paginate(10);
        else {
            $results = Role::findById($department)->users;
            $users = CollectionHelper::paginate($results, $results->count(), 10);
        }
        return view('otherworks-management.report.user', compact('users'));
    }

    public function search(Request $request)
    {
        if ($request->search != '') {
            $search_results = OtherWork::FullTextSearch('name', $request->search)->limit(5)->get();
            return view('otherworks-management.search', compact('search_results'));
        }
    }

    public function reportDepartment()
    {
        $departments = Role::where('id', '>', 3)->paginate(10);
        return view('otherworks-management.report.department', compact('departments'));
    }

    public function export()
    {
        return new OtherWorksAllExport();
    }
}
