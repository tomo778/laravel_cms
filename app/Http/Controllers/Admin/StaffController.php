<?php

namespace App\Http\Controllers\Admin;

// 以下を追加
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Admin\StaffService;
use App\Rules\UniqueEmail;
use Validator;
use DB;

class StaffController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index()
    {
        $pagination = $this->staffService->list();
        return view('admin.staff.index', compact('pagination'));
    }

    public function create()
    {
        return view('admin.staff.edit');
    }

    public function createExecute(Request $request)
    {
        $last_id = DB::transaction(function () use ($request) {
            return $this->staffService->create($request);
        });
        return redirect('admin/staff/edit/' . $last_id)->with('one_time_mes', 1);
    }

    public function update(int $id)
    {
        $update_datas = $this->staffService->updateDatas($id);
        return view('admin.staff.edit', compact('update_datas'));
    }

    public function updateExecute(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->staffService->update($request);
        });
        return redirect('admin/staff/edit/' . $request->id)->with('one_time_mes', 2);
    }

    public function validateForm(Request $request)
    {
        $array = [
            'name'  => ['required', 'max:100'],
            'email' => ['required', 'email', new UniqueEmail($request->all())],
            'password' => ['required', 'max:100'],
        ];
        if (!empty($request['id'])) {
            unset($array['password']);
        }
        $validator = Validator::make($request->all(), $array);
        if ($validator->fails()) {
            return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return json_encode(['success' => true]);
        }
    }
}
