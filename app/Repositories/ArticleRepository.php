<?php

namespace App\Repositories;

use App\Contracts\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('tags')->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with('tags')->paginate($perPage);
    }

    public function getFeaturedArticle()
    {
        return $this->model->where('is_featured', true)->first();
    }

    public function getTopArticles(int $limit = 6)
    {
        return $this->model->where('is_featured', false)->orderBy('display_order', 'asc')->limit($limit)->get();
    }

    public function find($id)
    {
        return $this->model->with('tags')->findOrFail($id);
    }

    public function create(array $data, array $tagIds = [], ?UploadedFile $file = null)
    {
        DB::beginTransaction();

        try {
            if (!isset($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if ($file instanceof UploadedFile) {
                $data['image'] = $this->storeImage($file);
            }

            $data['created_by'] = Auth::id();
            $data['reading_time'] = $this->calculateReadingTime($data['content']);

            if (!empty($data['is_featured']) && $data['is_featured']) {
                $this->model->where('is_featured', true)->update(['is_featured' => false]);
            } else {
                $data['is_featured'] = false;
            }

            $article = $this->model->create($data);

            if (!empty($tagIds)) {
                $article->tags()->attach($tagIds);
            }

            DB::commit();
            return $article;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Article creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update($id, array $data, array $tagIds = [], ?UploadedFile $file = null)
    {
        DB::beginTransaction();

        try {
            $article = $this->find($id);

            if (isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if (isset($data['content'])) {
                $data['reading_time'] = $this->calculateReadingTime($data['content']);
            }

            if ($file instanceof UploadedFile) {
                $this->deleteOldImage($article->image);
                $data['image'] = $this->storeImage($file);
            }

            $data['updated_by'] = Auth::id();

            if (!empty($data['is_featured']) && $data['is_featured']) {
                $this->model->where('is_featured', true)
                            ->where('id', '!=', $id)
                            ->update(['is_featured' => false]);
            } else {
                $data['is_featured'] = false;
            }

            $article->update($data);

            if (!empty($tagIds)) {
                $article->tags()->sync($tagIds);
            } else {
                $article->tags()->detach();
            }

            DB::commit();
            return $article;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Article update failed: {$e->getMessage()}");
            throw $e;
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $article = $this->find($id);

            $this->deleteOldImage($article->image);

            $article->tags()->detach();

            $article->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Article deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }

    private function storeImage(UploadedFile $file)
    {
        return $file->store('articles', 'public');
    }

    private function deleteOldImage(?string $path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $wordsPerMinute = 250;
        $minutes = ceil($wordCount / $wordsPerMinute);
        return max(1, $minutes);
    }
}
