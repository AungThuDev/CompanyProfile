<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\ProjectRepositoryInterface;
use App\Contracts\ServiceRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

class FrontendController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;
    protected ProjectRepositoryInterface $projectRepository;
    protected ArticleRepositoryInterface $articleRepository;
    protected CategoryRepositoryInterface $categoryRepository;


    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ProjectRepositoryInterface $projectRepository,
        ArticleRepositoryInterface $articleRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->projectRepository = $projectRepository;
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->all()->map(function ($service) {
            return [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
                'description' => $service->description,
            ];
        });

        $projects = $this->projectRepository->all()->map(function ($project) {
            return [
                'id' => $project->id,
                'title' => $project->title,
                'slug' => $project->slug,
                'image' => $project->image,
                'description' => $project->description,
                'url' => $project->project_url,
                'category' => optional($project->projectType)->name,
            ];
        });
        $categories = $this->categoryRepository->all()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
        $articles = $this->articleRepository->all()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'category' => $article->category->name,
                    'title' => $article->title,
                    'content' => $article->content,
                    'image' => $article->image,
                    'display_order' => $article->display_order,
                    'featured' => false,
                    'created_at' => $article->created_at->toDateString(),
                ];
            })
            ->sortBy('display_order')
            ->values();
        $initialState = [
            'services' => $services,
            'projects' => $projects,
            'articles' => $articles,
            'categories' => $categories,
        ];
        return view('frontend.app', compact('initialState'));
    }
}
