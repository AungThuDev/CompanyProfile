<?php 

namespace App\Repositories\Backend;

use App\Contracts\Backend\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{ 
     protected $model;

     public function __construct(Category $model)
     { 
          $this->model = $model;
     }

     public function all()
     { 
          return $this->model->all();
     }

     public function find(int $id)
     { 
          return $this->model->findOrFail($id);
     }

     public function paginate(int $perPage = 10)
     { 
          return $this->model->paginate($perPage);
     }

     public function create(array $data)
     { 
          DB::beginTransaction();

          try { 
               $data['slug'] = Str::slug($data['name']);
               $data['created_by'] = Auth::id();
               $this->model->create($data);
               DB::commit();
               return;
          }catch(Exception $e) { 
               DB::rollBack();
               Log::error("Category creation failed: {$e->getMessage()}");
               throw $e;
          }
     }

     public function update(int $id, array $data)
     { 
          DB::beginTransaction();

          try { 
               $category = $this->find($id);
               if(isset($data['name']) && $data['name'] !==  $category->name) { 
                    $data['slug'] = Str::slug($data['name']);
               }

               $data['updated_by'] = Auth::id();

               $category->update($data);
               DB::commit();
               return;
          }catch(Exception $e) { 
               DB::rollBack();
               Log::error("Category update failed: {$e->getMessage()}");
               throw $e;
          }
     }

     public function destroy(int $id)
     { 
          DB::beginTransaction();
          try { 
               $category = $this->find($id);
               $category->delete();
               DB::commit();
               return;
          }catch(Exception $e) { 
               DB::rollBack();
               Log::error("Category deletion failed: {$e->getMessage()}");
               throw $e;
          }
     }
}