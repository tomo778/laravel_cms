<?php

namespace App\Http\Controllers\Admin;

// 以下を追加
use App\Http\Controllers\Controller;
use App\Services\Admin\FileService;
use App\Services\Admin\ProductService;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use DB;

class ProductController extends Controller
{
    private $fileService;
    private $productService;
    private $categoryService;

    public function __construct(
        FileService $fileService,
        ProductService $productService,
        CategoryService $categoryService
    ) {
        $this->fileService = $fileService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $pagination = $this->productService->list();
        return view('admin.product.index', compact('pagination'));
    }

    public function create()
    {
        return view('admin.product.edit');
    }

    public function createExecute(Request $request)
    {
        $last_id = DB::transaction(
            function () use ($request) {
                $request = $this->fileService->create($request);
                return $this->productService->create($request);
            }
        );
        $this->categoryService->categorysFlontSet();
        return redirect('admin/product/edit/' . $last_id)->with('one_time_mes', 1);
    }

    public function update(int $id)
    {
        $update_datas = $this->productService->updateDatas($id);
        $select_category = $update_datas->add_category->pluck('id')->toArray();
        return view('admin.product.edit', compact('update_datas', 'select_category'));
    }

    public function updateExecute(Request $request)
    {
        $request = $this->fileService->update($request);
        $this->productService->update($request);
        $this->categoryService->categorysFlontSet();
        return redirect('admin/product/edit/' . $request->id)->with('one_time_mes', 2);
    }

    public function checkbox(Request $request)
    {
        switch ($request->mode) {
            case 1:
                $this->checkOn($request);
                break;
            case 2:
                $this->checkOff($request);
                break;
            case 3:
                $this->checkDelete($request);
                break;
            default:
                return json_encode(['success' => false]);
                break;
        }
        return json_encode(['success' => true]);
    }

    public function checkOn(Request $request): void
    {
        DB::transaction(
            function () use ($request) {
                Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_ON')]);
            }
        );
    }

    public function checkOff(Request $request): void
    {
        DB::transaction(
            function () use ($request) {
                Product::whereIn('id', $request->vals)->update(['status' => config('const.STATUS_OFF')]);
            }
        );
    }

    public function checkDelete(Request $request): void
    {
        DB::transaction(
            function () use ($request) {
                Product::destroy($request->vals);
            }
        );
    }

    public function validateForm(Request $request)
    {
        $array = [
            'title'  => ['required', 'max:100'],
            'text' => ['required', 'max:1000'],
            'category'  => 'required',
            'price'  => ['required', 'integer', 'max:10000000'],
            'num' => ['required', 'integer', 'max:1000'],
            'file_data' => [
                'required',
                'mimes:jpeg,bmp,png',
                'dimensions:min_width=100,min_height=200'
            ],
        ];
        if (!empty($request->file_name) && empty($request->file_data)) {
            unset($array['file_data']);
        }
        $validator = Validator::make($request->all(), $array);
        if ($validator->fails()) {
            return json_encode(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return json_encode(['success' => true]);
        }
    }
}
