<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File as File2;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProduct($request)
    {
        $keyword = isset($request->keyword)? $request->keyword : '';
        $start_date = isset($request->date_start)? $request->date_start : '';
        $end_date = isset($request->date_end)? $request->date_end : '';
        $category = isset($request->category)? $request->category : '';

        $products = $this->model->query();

        if ($keyword != "") {
            $products = $products->where(function ($query) use ($keyword) {
                $query->where('pro_name', 'like', '%'.$keyword.'%')
                    ->orWhere('pro_quantity', 'like', '%'.$keyword.'%')
                    ->orWhere('pro_price', 'like', '%'.$keyword.'%');
            });
        }

        if ($end_date != "") {
            $products = $products->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        if ($category != "") {
            $products= $products->where('pro_parent_id', '=', $category);
        }

        return $products->get();
    }

    public function postProduct($request)
    {
        $data = $request->all();

        $files = [];
        if ($request->hasfile('pro_avatar')) {
            foreach ($request->file('pro_avatar') as $file) {
                $name = time().rand(1, 100).'.'.$file->extension();
                $file->move(public_path('files_product'), $name);
                $files[] = $name;
            }
        }
        $product = $this->model->create($data);

        $product->pro_avatar = $files;

        $product->save();
    }

    public function updateProduct($request, $id)
    {
        $data = $request->all();

        $product_id = $this->model->find($id);

        $product_id->update($data);

        $files = [];
        $files_remove = [];
        if ($request->hasfile('pro_avatar')) {
            foreach ($request->file('pro_avatar') as $file) {
                $name = time().rand(1, 100).'.'.$file->extension();
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
  
        // $file = $this->model->find($id);
        $product_id->pro_avatar = $files;
        if ($product_id->save()) {
            foreach ($files_remove as $file_name) {
                File2::delete(public_path("files_product/".$file_name));
            }
        }
    }
}
