<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\ProjectRepositoryInterface;
use App\Contracts\ServiceRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\CompanyInfoRepositoryInterface;
use App\Contracts\SocialAccountRepositoryInterface;

class FrontendController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;
    protected ProjectRepositoryInterface $projectRepository;
    protected ArticleRepositoryInterface $articleRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    protected CompanyInfoRepositoryInterface $companyInfoRepository;
    protected SocialAccountRepositoryInterface $socialAccountRepository;



    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ProjectRepositoryInterface $projectRepository,
        ArticleRepositoryInterface $articleRepository,
        CategoryRepositoryInterface $categoryRepository,
        CompanyInfoRepositoryInterface $companyInfoRepository,
        SocialAccountRepositoryInterface $socialAccountRepository

    ) {
        $this->serviceRepository = $serviceRepository;
        $this->projectRepository = $projectRepository;
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->companyInfoRepository = $companyInfoRepository;
        $this->socialAccountRepository = $socialAccountRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->all()->map(function ($service) {
            return [
                'id' => $service->id,
                'title' => $service->title,
                'icon' => $service->icon,
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
        $blogPosts = $this->articleRepository->getTopArticles()
            ->map(function ($blogPost) {
                return [
                    'id' => $blogPost->id,
                    'category' => $blogPost->category->name,
                    'title' => $blogPost->title,
                    'content' => $blogPost->content,
                    'image' => $blogPost->image,
                    'display_order' => $blogPost->display_order,
                    'featured' => $blogPost->is_featured,
                    'created_at' => $blogPost->created_at->toDateString(),
                    'tags' => $blogPost->tags->map(function ($tag) {
                        return [
                            'id' => $tag->id,
                            'name' => $tag->name,
                        ];
                    }),
                ];
            });
        $allArticles = $this->articleRepository->all()
            ->map(function ($allArticle) {
                return [
                    'id' => $allArticle->id,
                    'category' => $allArticle->category->name,
                    'title' => $allArticle->title,
                    'content' => $allArticle->content,
                    'image' => $allArticle->image,
                    'display_order' => $allArticle->display_order,
                    'featured' => $allArticle->is_featured,
                    'created_at' => $allArticle->created_at->toDateString(),
                    'tags' => $allArticle->tags->map(function ($tag) {
                        return [
                            'id' => $tag->id,
                            'name' => $tag->name,
                        ];
                    }),
                ];
            });
        $featuredPost = $this->articleRepository->getFeaturedArticle();

        $featuredPost = $this->articleRepository->getFeaturedArticle();

        if ($featuredPost) {
            $featuredPostArray = [
                'id' => $featuredPost->id,
                'category' => $featuredPost->category->name,
                'title' => $featuredPost->title,
                'content' => $featuredPost->content,
                'image' => $featuredPost->image,
                'display_order' => $featuredPost->display_order,
                'featured' => $featuredPost->is_featured,
                'created_at' => $featuredPost->created_at->toDateString(),
                'tags' => $featuredPost->tags->map(function ($tag) {
                    return [
                        'id' => $tag->id,
                        'name' => $tag->name,
                    ];
                })->toArray(),
            ];
        } else {
            $featuredPostArray = null;
        }

        $contactInfo = $this->companyInfoRepository->getActive();
        $socialLinks = $this->socialAccountRepository->getTopSocialAccounts()->map(function ($socialLink) {
            return [
                'id' => $socialLink->id,
                'logo' => $socialLink->logo,
                'name' => $socialLink->name,
                'account_link' => $socialLink->account_link,
            ];
        });

        $initialState = [
            'services' => $services,
            'projects' => $projects,
            'blogPosts' => $blogPosts,
            'categories' => $categories,
            'featuredPosts' => $featuredPostArray,
            'allArticles' => $allArticles,
            'contactInfo' => $contactInfo,
            'socialLinks' => $socialLinks,
        ];

        return view('frontend.app', compact('initialState'));
    }
}
