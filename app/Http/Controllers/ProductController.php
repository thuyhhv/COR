<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File as File2;
use App\Models\Category;
use App\Traits\CsvTrait;
use App\Traits\ProductTrait;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;
    use CsvTrait;
    use ProductTrait;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        // $this->middleware('auth');
        $this->productRepo = $productRepo;
    }

    public function index(Request $request)
    {
        $categories = Category::select('id', 'name')->get();

        $products = $this->productRepo->getProduct($request);
        $start_date = Carbon::now()->subDays(30)->format('Y-m-d');
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $request->keyword,
            'start_date' => $start_date,
            'end_date' => $request->end_date,
            'category'=> $request->category,
        ];

        return view('product.list', $data);
    }

    public function show($id)
    {
        $product = $this->productRepo->find($id);

        return view('home.product', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('product.create', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $products = $this->productRepo->find($id);
        $categories = Category::select('id', 'name')->get();

        return view('product.edit', ['products' => $products, 'categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        
        $product = $this->productRepo->postProduct($request);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepo->updateProduct($request, $id);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $products = $this->allProduct()->toArray();
        $filename = Str::slug($products[0]['pro_name'], '-') . "-products_" . time() . ".csv";
        return $this->exportCsv($products, $filename);
    }
}
