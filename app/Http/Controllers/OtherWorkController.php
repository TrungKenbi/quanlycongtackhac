<?php


namespace App\Http\Controllers;

use App\Authorizable;
use App\Models\OtherWork;
use App\Models\OtherWorkFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otherworks = OtherWork::latest()->paginate(5);
        return view('otherworks.index', compact('otherworks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'documents' => 'array',
            'documents.*' => 'file|max:10000|mimes:txt,pdf,docx,doc,docm,pptx,pptm,xlsx,xlsm',
            'photos' => 'array',
            'photos.*' => 'image',
            'users' => 'required',
            //'users.*' => 'numeric|min:1|exists:users,id',
        ]);

        $otherwork = OtherWork::create($request->only(['name', 'detail']));

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
        $documents = $otherwork->getDocuments;
        $photos = $otherwork->getPhotos;
        return view('otherworks.show', compact('otherwork', 'documents', 'photos'));
    }

    public function downloadFile($id = 0)
    {
        if ($id)
            return;
        $file = OtherWorkFile::find($id);
        if ($file != null)
        return Storage::download('public/documents/');
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
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $otherwork->update($request->all());


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
}
