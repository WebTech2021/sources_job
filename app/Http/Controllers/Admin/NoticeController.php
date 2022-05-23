<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\PaginateResource;
use App\Models\JobSeeker\JobSeeker;
use App\Models\Notice;
use App\Models\NoticeReceiver;
use App\Models\NoticeReciver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notices = Notice::with('receiver');
        return response()->json(['success' => true, 'notices' => new PaginateResource($notices->latest()->paginate(20), NoticeResource::class)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'min:5', 'max:255'],
            'type' => ['required', 'string', 'in:select,all'],
            'data' => ['required', 'min:5', 'max:255'],
            'users' => ['required_if:type,==,select', 'array'],
        ]);
        try {
            DB::beginTransaction();
            $notice = new Notice();
            $notice->subject = $validated['subject'];
            $notice->data = $validated['data'];
            $notice->save();
            $users = $request->users;
            if ($request->type == 'all') {
                $users = JobSeeker::select('id')->get()->pluck('id');
            }
            foreach ($users as $id) {
                $noticeSent = new NoticeReceiver();
                $noticeSent->user_id = $request->type == 'all' ? $id : decrypt($id);
                $noticeSent->notice_id = $notice->id;
                $noticeSent->save();
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Successfully Sent']);
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $notice = Notice::findOrFail(decrypt($id));
            $notice->delete();
            return response()->json(['success' => true, 'message' => 'Notice Deleted']);

        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'No notice found!']);
        }
    }

    public function deleteNotices()
    {
        $notices = Notice::where('created_at', '<=', Carbon::now()->subMonths(1));
        if ($notices->delete()) {
            return response()->json(['success' => true, 'message' => 'Notice Deleted']);
        }
        return response()->json(['success' => false,'subject'=>'Unable to Delete', 'message' => 'No notice found before 1 month!']);
    }
}
