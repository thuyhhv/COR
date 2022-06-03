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
use Carbon\Carbon;

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

    public function index(Request $request)
    {
        $categories = $this->categoryRepo->getCategory($request);
        $start_date = Carbon::now()->subDays(30)->format('Y-m-d');
        
        $data = [
            'categories' => $categories,
            'keyword' => $request->keyword,
            'start_date' => $start_date,
            'end_date' => $request->end_date,
        ];

        return view('category.list', $data);
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
		$categories = $this->categoryRepo->postCategory($request);

        return redirect()->back();

    }

    public function update(Request $request, $id)
    {

        $categories = $this->categoryRepo->updateCategory($request, $id);

        return redirect()->back();

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
