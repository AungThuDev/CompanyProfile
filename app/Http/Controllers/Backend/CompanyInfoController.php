<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\CompanyInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyInfoController extends Controller
{
    protected CompanyInfoRepositoryInterface $companyInfoRepository;

    public function __construct(CompanyInfoRepositoryInterface $companyInfoRepository)
    {
        $this->companyInfoRepository = $companyInfoRepository;
    }

    public function index()
    {
        $companyInfos = $this->companyInfoRepository->all();
        return view('dashboard.company-infos.index', compact('companyInfos'));
    }

    public function show(int $id)
    { 
        $companyInfo = $this->companyInfoRepository->find($id);
        return view('dashboard.company-infos.show', compact('companyInfo'));
    }

    public function create()
    {
        return view('dashboard.company-infos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        try {

            if($this->companyInfoRepository->getActive()) { 
                return back()->withErrors(['error' => 'An active company info already exists. Please delete it before creating a new one.'])
                             ->withInput();
            }

            $this->companyInfoRepository->create($validated, $request->file('logo'));
            return redirect()->route('dashboard.company-infos.index')
                             ->with('success', 'Company info created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create company info. Please try again.'])
                         ->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $companyInfo = $this->companyInfoRepository->find($id);
            return view('dashboard.company-infos.edit', compact('companyInfo'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.company-infos.index')
                             ->withErrors(['error' => 'Company info not found or could not be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $this->companyInfoRepository->update($id, $validated, $request->file('logo'));
            return redirect()->route('dashboard.company-infos.index')
                             ->with('success', 'Company info updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update company info. Please try again.'])
                         ->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->companyInfoRepository->destroy($id);
            return redirect()->route('dashboard.company-infos.index')
                             ->with('success', 'Company info deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.company-infos.index')
                             ->withErrors(['error' => 'Failed to delete company info. Please try again.']);
        }
    }
}
