<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File as File2;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategory($request)
    {
		$keyword = isset($request->keyword)? $request->keyword : '';
		$start_date = isset($request->date_start)? $request->date_start : '';
		$end_date = isset($request->date_end)? $request->date_end : '';

        $categories = $this->model->query();

		if ($keyword != "" ) {
			$categories = $categories->where(function ($query) use ($keyword) {
                $query->where('name','like','%'.$keyword.'%');
            });
		}

		if ($end_date != "" ) {
			$categories = $categories->whereDate( 'created_at', '>=', $start_date )->whereDate( 'created_at', '<=', $end_date);
		}

		return $categories->get();
    }

    public function postCategory($request)
    {
        $data = $request->all();

        $files = [];
        if($request->hasfile('avatar'))
		{
			foreach($request->file('avatar') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
			    $file->move(public_path('files'), $name);  
			    $files[] = $name;  
			}
		}
  
		$categories = $this->model->create($data);

		$categories->avatar = $files;

		$categories->save();
    }

    public function updateCategory($request, $id)
    {
        $data = $request->all();

		$categories_id = $this->model->find($id);

        $categories_id->update( $data);

        $files = [];
        $files_remove = [];
        if($request->hasfile('avatar'))
		{
			foreach($request->file('avatar') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
			    $file->move(public_path('files'), $name);  
			    $files[] = $name;  
			}
		}

		if (isset($data['images_uploaded'])) {
			$files_remove = array_diff(json_decode($data['images_uploaded_origin']), $data['images_uploaded']);
			$files = array_merge($data['images_uploaded'], $files);
		} else {
			$files_remove = json_decode($data['images_uploaded_origin']);
		}
  
		$categories_id->avatar = $files;
		if($categories_id->save()) {
			foreach ($files_remove as $file_name) {
				File2::delete(public_path("files/".$file_name));
			}
		}
    }
}