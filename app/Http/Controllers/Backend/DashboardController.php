<?php 

namespace App\Http\Controllers\Backend;

use App\Contracts\ProjectRepositoryInterface;
use App\Contracts\ProjectTypeRepositoryInterface;
use App\Contracts\ServiceRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\TagRepositoryInterface;
use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\CompanyInfoRepositoryInterface;
use App\Contracts\ContactUsRepositoryInterface;
use App\Contracts\SocialAccountRepositoryInterface;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{ 
    protected UserRepositoryInterface $userRepository;
    protected ProjectTypeRepositoryInterface $projectTypeRepository;
    protected ProjectRepositoryInterface $projectRepository;
    protected ServiceRepositoryInterface $serviceRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    protected TagRepositoryInterface $tagRepository;
    protected ArticleRepositoryInterface $articleRepository;
    protected CompanyInfoRepositoryInterface $companyInfoRepository;
    protected SocialAccountRepositoryInterface $socialAccountRepository;
    protected ContactUsRepositoryInterface $contactUsRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProjectTypeRepositoryInterface $projectTypeRepository, 
        ProjectRepositoryInterface $projectRepository, 
        ServiceRepositoryInterface $serviceRepository,
        CategoryRepositoryInterface $categoryRepository,
        TagRepositoryInterface $tagRepository,
        ArticleRepositoryInterface $articleRepository,
        CompanyInfoRepositoryInterface $companyInfoRepository,
        SocialAccountRepositoryInterface $socialAccountRepository,
        ContactUsRepositoryInterface $contactUsRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->projectTypeRepository = $projectTypeRepository;
        $this->projectRepository = $projectRepository;
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->articleRepository = $articleRepository;
        $this->companyInfoRepository = $companyInfoRepository;
        $this->socialAccountRepository = $socialAccountRepository;
        $this->contactUsRepository = $contactUsRepository;
    }

    public function index()
    { 
        $userCount = count($this->userRepository->all());
        $projectTypeCount = count($this->projectTypeRepository->all());
        $projectCount = count($this->projectRepository->all());
        $serviceCount = count($this->serviceRepository->all());
        $categoryCount = count($this->categoryRepository->all());
        $tagCount = count($this->tagRepository->all());
        $articleCount = count($this->articleRepository->all());
        $companyInfoCount = count($this->companyInfoRepository->all());
        $socialAccountCount = count($this->socialAccountRepository->all());
        $contactMessagesCount = count($this->contactUsRepository->all());

        return view(
            'dashboard.index', 
            compact(
                'userCount', 
                'projectTypeCount', 
                'projectCount', 
                'serviceCount', 
                'categoryCount', 
                'tagCount', 
                'articleCount',
                'companyInfoCount',
                'socialAccountCount',
                'contactMessagesCount',
            )
        );
    }
}
