<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use Validator;
use DB;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): \Illuminate\View\View
    {
        $pagination = $this->categoryService->list();
        return view('admin.category.index', compact('pagination'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admin.category.edit');
    }

    public function createExecute(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $last_id = DB::transaction(
            function () use ($request) {
                return $this->categoryService->create($request);
            }
        );
        return redirect('admin/category/edit/' . $last_id)->with('one_time_mes', 1);
    }

    public function update($id): \Illuminate\View\View
    {
        $update_datas = $this->categoryService->updateDatas($id);
        return view('admin.category.edit', compact('update_datas'));
    }

    public function updateExecute(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        DB::transaction(
            function () use ($request) {
                $this->categoryService->update($request);
            }
        );
        $this->categoryService->categorysFlontSet();
        return redirect('admin/category/edit/' . $request->id)->with('one_time_mes', 2);
    }

    public function validateForm(Request $request): string
    {
        $validator = Validator::make($request->all(), [
            'title'  => ['required', 'max:100'],
            'text' => ['required', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return json_encode(['success' => true]);
        }
    }
}
