<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File as File2;
use App\Traits\CsvTrait;
use App\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Support\Str; 

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
     */
    protected $categoryRepo;
    use CsvTrait;
    use CategoryTrait;

    public function __construct(categoryRepositoryInterface $categoryRepo)
    {
        // $this->middleware('auth');
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getCategory();

        return view('category.list', ['categories' => $categories]);
    }

    public function show($id)
    {
        $categories = $this->categoryRepo->find($id);

        return view('home.category', ['categories' => $categories]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function edit($id)
    {
        $categories = $this->categoryRepo->find($id);

        return view('category.edit', ['categories' => $categories]);
    }

    public function store(CategoryRequest $request)
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
  
		$categories = $this->categoryRepo->create($data);

		$categories->avatar = $files;

		$categories->save();
  
        return redirect()->back()->with('success', 'Data Your files has been successfully added');

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $categories = $this->categoryRepo->update($id, $data);

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
  
        $file = $this->categoryRepo->find($id);
		$file->avatar = $files;
		if($file->save()) {
			foreach ($files_remove as $file_name) {
				File2::delete(public_path("files/".$file_name));
			}
		}

        return redirect()->back()->with('success', 'Data Your files has been successfully updated');

    }

    public function destroy($id)
    {
        $this->categoryRepo->delete($id);
        
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $categories = $this->allCategory()->toArray();
        $filename = Str::slug($categories[0]['name'], '-') . "-category_" . time() . ".csv";
        return $this->exportCsv($categories, $filename);
    }
}
