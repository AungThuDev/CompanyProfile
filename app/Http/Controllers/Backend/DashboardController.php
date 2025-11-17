<?php 

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\ProjectRepositoryInterface;
use App\Contracts\Backend\ProjectTypeRepositoryInterface;
use App\Contracts\Backend\ServiceRepositoryInterface;
use App\Contracts\Backend\UserRepositoryInterface;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{ 
    protected UserRepositoryInterface $userRepository;
    protected ProjectTypeRepositoryInterface $projectTypeRepository;
    protected ProjectRepositoryInterface $projectRepository;
    protected ServiceRepositoryInterface $serviceRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProjectTypeRepositoryInterface $projectTypeRepository, 
        ProjectRepositoryInterface $projectRepository, 
        ServiceRepositoryInterface $serviceRepository, 
    )
    {
        $this->userRepository = $userRepository;
        $this->projectTypeRepository = $projectTypeRepository;
        $this->projectRepository = $projectRepository;
        $this->serviceRepository = $serviceRepository;
    }
    public function index()
    { 
        $userCount = count($this->userRepository->all());
        $projectTypeCount = count($this->projectTypeRepository->all());
        $projectCount = count($this->projectRepository->all());
        $serviceCount = count($this->serviceRepository->all());

        return view('dashboard.index', compact('userCount', 'projectTypeCount', 'projectCount', 'serviceCount'));
    }
}