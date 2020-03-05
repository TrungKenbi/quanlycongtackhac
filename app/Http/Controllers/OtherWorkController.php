<?php


namespace App\Http\Controllers;

use App\Authorizable;
use App\Models\OtherWork;
use App\Models\OtherWorkFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Exports\OtherWorksExport;


class OtherWorkController extends Controller
{
    //use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:otherwork-list|otherwork-create|otherwork-edit|otherwork-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:otherwork-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:otherwork-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:otherwork-delete', ['only' => ['destroy']]);
    }

    private function checkOwnerOrAdmin($otherwork)
    {
        return (!Auth::user()->hasRole(['Admin   ', 'Manager']) && $otherwork->user_id != \Auth::id());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otherworks = OtherWork::where('user_id', \Auth::id())->get(['norm', 'count']);

        $otherworksCount = 0;
        $otherworksPointSum = 0;

        foreach ($otherworks as $otherwork)
        {
            $otherworksCount++;
            $otherworksPointSum += $otherwork->norm * $otherwork->count * (103 / 320);
        }

        $otherworksPointSum = intval($otherworksPointSum);

        $otherworks = OtherWork::where('user_id', \Auth::id())->latest()->paginate(5);


        return view('otherworks.index', compact(
            'otherworks',
            'otherworksPointSum',
            'otherworksCount'
        ))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('otherworks.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'norm' => 'required|numeric',
            'count' => 'required|numeric',
            'documents' => 'array',
            'documents.*' => 'file|max:10000|mimes:txt,pdf,docx,doc,docm,pptx,pptm,xlsx,xlsm',
            'photos' => 'array',
            'photos.*' => 'image',
            //'users' => 'required',
            //'users.*' => 'numeric|min:1|exists:users,id',
        ], [
            '*.required' => ':attribute không được bỏ trống',
        ], [
            'name' => 'Tên công tác',
            'detail' => 'Nội dung công tác',
        ]);

        $data = $request->only(['name', 'detail', 'norm', 'count']);
        $data['user_id'] = \Auth::id();

        $otherwork = OtherWork::create($data);

        if ($request->has('documents')) {
            foreach ($request->documents as $document) {
                $filename = $document->store('documents', 'public');
                OtherWorkFile::create([
                    'other_work_id' => $otherwork->id,
                    'filename' => $filename,
                    'display_name' => $document->getClientOriginalName(),
                    'type' => 'document'
                ]);
            }
        }

        if ($request->has('photos')) {
            foreach ($request->photos as $photo) {
                $filename = $photo->store('photos', 'public');
                OtherWorkFile::create([
                    'other_work_id' => $otherwork->id,
                    'filename' => $filename,
                    'display_name' => $photo->getClientOriginalName(),
                    'type' => 'photo'
                ]);
            }
        }

        return redirect()->route('otherworks.index')
            ->with('success', 'Tạo công tác thành công !!!');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\otherwork $otherwork
     * @return \Illuminate\Http\Response
     */
    public function show(OtherWork $otherwork)
    {
        if ($this->checkOwnerOrAdmin($otherwork))
            return redirect('otherworks');
        $documents = $otherwork->getDocuments;
        $photos = $otherwork->getPhotos;
        return view('otherworks.show', compact('otherwork', 'documents', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\otherwork $otherwork
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherWork $otherwork)
    {
        return view('otherworks.edit', compact('otherwork'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\otherwork $otherwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherWork $otherwork)
    {

        //dd($request->documents);

        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'norm' => 'required|numeric',
            'count' => 'required|numeric',
            'documents' => 'array',
            'documents.*' => 'bail|file|max:10000|mimes:txt,pdf,docx,doc,docm,pptx,pptm,xlsx,xlsm',
            'photos' => 'array',
            'photos.*' => 'bail|max:10000|image',
        ]);


        $otherwork->update($request->only(['name', 'detail', 'norm', 'count']));


        if ($request->has('documents')) {
            foreach ($request->documents as $document) {
                $filename = $document->store('documents', 'public');
                OtherWorkFile::create([
                    'other_work_id' => $otherwork->id,
                    'filename' => $filename,
                    'display_name' => $document->getClientOriginalName(),
                    'type' => 'document'
                ]);
            }
        }

        if ($request->has('photos')) {
            foreach ($request->photos as $photo) {
                $filename = $photo->store('photos', 'public');
                OtherWorkFile::create([
                    'other_work_id' => $otherwork->id,
                    'filename' => $filename,
                    'display_name' => $photo->getClientOriginalName(),
                    'type' => 'photo'
                ]);
            }
        }


        return redirect()->route('otherworks.index')
            ->with('success', 'Sửa công tác thành công !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\otherwork $otherwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherWork $otherwork)
    {
        $otherwork->delete();


        return redirect()->route('otherworks.index')
            ->with('success', 'Xóa công tác thành công !');
    }

    public function export()
    {
        return new OtherWorksExport(Auth::id());
    }

    public function downloadFile($id = 0)
    {
        $file = OtherWorkFile::find($id);
        if (isset($file->id) && $file->filename != null)
        {
            $otherwork = OtherWork::find($file->id);
            if ($otherwork->user_id == \Auth::id())
                return Storage::download('public/' . $file->filename, $file->display_name);
        }
        return "File not found !!!";
    }

}
