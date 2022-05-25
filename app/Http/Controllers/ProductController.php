<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File as File2;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        // $this->middleware('auth');
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getProduct();
        $categories = Category::select('id','name')->get();

        return view('product.list', ['products' => $products, 'categories' => $categories]);
    }

    public function show($id)
    {
        $product = $this->productRepo->find($id);

        return view('home.product', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('product.create', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $products = $this->productRepo->find($id);
        $categories = Category::select('id','name')->get();

        return view('product.edit', ['products' => $products, 'categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $files = [];
        if($request->hasfile('pro_avatar'))
		{
			foreach($request->file('pro_avatar') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
			    $file->move(public_path('files_product'), $name);  
			    $files[] = $name;  
			}
		}
		$product = $this->productRepo->create($data);

		$product->pro_avatar = $files;

		$product->save();
  
        return redirect()->back()->with('success', 'Data Your files has been successfully added');

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $product = $this->productRepo->update($id, $data);

        $files = [];
        $files_remove = [];
        if($request->hasfile('pro_avatar'))
		{
			foreach($request->file('pro_avatar') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
			    $file->move(public_path('files_product'), $name);  
			    $files[] = $name;  
			}
		}

		if (isset($data['images_uploaded'])) {
			$files_remove = array_diff(json_decode($data['images_uploaded_origin']), $data['images_uploaded']);
			$files = array_merge($data['images_uploaded'], $files);
		} else {
			$files_remove = json_decode($data['images_uploaded_origin']);
		}
  
        $file = $this->productRepo->find($id);
		$file->pro_avatar = $files;
		if($file->save()) {
			foreach ($files_remove as $file_name) {
				File2::delete(public_path("files_product/".$file_name));
			}
		}

        return redirect()->back()->with('success', 'Data Your files has been successfully updated');

    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        
        return redirect()->back();
    }
}