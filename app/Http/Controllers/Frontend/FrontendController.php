<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\ServiceRepositoryInterface;
use App\Contracts\ProjectRepositoryInterface;

class FrontendController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;
    protected ProjectRepositoryInterface $projectRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ProjectRepositoryInterface $projectRepository
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->all()->map(function ($s) {
            return [
                'id' => $s->id,
                'title' => $s->title,
                'slug' => $s->slug,
                'description' => $s->description,
            ];
        });

        $projects = $this->projectRepository->all()->map(function ($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'image' => $p->image,
                'description' => $p->description,
                'url' => $p->project_url,
                'category' => optional($p->projectType)->name,
            ];
        });

        $initialState = [
            'services' => $services,
            'projects' => $projects,
        ];
        return view('frontend.app', compact('initialState'));
    }
}

