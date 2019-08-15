<?php


namespace App\Http\Controllers;


use App\Models\OtherWork;
use App\Models\OtherWorkFile;
use Illuminate\Http\Request;


class OtherWorkController extends Controller
{
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
            'vanbans' => 'required'
        ]);

        // kiểm tra có files sẽ xử lý
        if ($request->hasFile('vanbans')) {
            $allowedfileExtension = ['jpg', 'png'];
            $files = $request->file('vanbans');
            // flag xem có thực hiện lưu DB không. Mặc định là có
            $exe_flg = true;
            // kiểm tra tất cả các files xem có đuôi mở rộng đúng không
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if (!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                    $exe_flg = false;
                    break;
                }
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
            if ($exe_flg) {
                // lưu product
                $otherwork = OtherWork::create($request->only(['name', 'detail']));
                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->vanbans as $vanban) {
                    $filename = $vanban->store('vanban');
                    OtherWorkFile::create([
                        'other_work_id' => $otherwork->id,
                        'filename' => $filename
                    ]);
                }
                return redirect()->route('otherworks.index')
                    ->with('success', 'Tạo công tác thành công !!!');
            } else {
                return redirect()->route('otherworks.index')
                    ->withErrors('File upload không hợp lệ');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\otherwork $otherwork
     * @return \Illuminate\Http\Response
     */
    public function show(OtherWork $otherwork)
    {
        return view('otherworks.show', compact('otherwork'));
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
