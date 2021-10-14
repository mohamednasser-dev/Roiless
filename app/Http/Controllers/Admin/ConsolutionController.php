<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Consolution;
use App\Models\reply;
class ConsolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:consolutions');
    }
    public function index()
    {
        $consolutions = Consolution::get();
        return view('admin.consolution.index', compact('consolutions'));
    }
    public function show($id)
    {
        $consolution = Consolution::find($id);
        if ($consolution) {
            $consolution->update(['seen' => '1']);
        }
        $replies = reply::where('consolution_id', $id)->get();
        if ($replies) {
            reply::where('consolution_id', '=', $id)
                ->update(['seen' => '1']);
        }
        return view('admin.consolution.consolution_show', compact('consolution', 'replies'));
    }
    public function admin_reply(Request $request)
    {
        reply::create([
            'consolution_id' => $request->consulation_id,
            'reply' => $request->reply,
            'admin_id' => Auth::user()->id,
        ]);
        return back();
    }
    public function Delete($id)
    {
        $Consolution = Consolution::find($id);
        $Consolution->Delete();
        return back();
    }
}
