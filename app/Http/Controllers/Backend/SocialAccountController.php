<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\CompanyInfoRepositoryInterface;
use App\Contracts\SocialAccountRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAccountController extends Controller
{
    protected SocialAccountRepositoryInterface $socialRepo;
    protected CompanyInfoRepositoryInterface $companyInfoRepo;

    public function __construct(SocialAccountRepositoryInterface $socialRepo, CompanyInfoRepositoryInterface $companyInfoRepo)
    {
        $this->socialRepo = $socialRepo;
        $this->companyInfoRepo = $companyInfoRepo;
    }

    public function index()
    {
        $accounts = $this->socialRepo->paginate();
        return view('dashboard.social-accounts.index', compact('accounts'));
    }

    public function show(int $id)
    {
        $account = $this->socialRepo->find($id);
        return view('dashboard.social-accounts.show', compact('account'));
    }

    public function create()
    {
        return view('dashboard.social-accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'account_link' => ['required', 'url'],
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        try {
            $companyInfo = $this->companyInfoRepo->getActive();
            if(!$companyInfo) { 
                return back()->withErrors(['error' => 'No active company information found.'])->withInput();
            }

            $validated['company_info_id'] = $companyInfo->id;
            $this->socialRepo->create($validated, $request->file('logo'));

            return redirect()
                ->route('dashboard.social-accounts.index')
                ->with('success', 'Social account created successfully.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to create social account.'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $account = $this->socialRepo->find($id);
            return view('dashboard.social-accounts.edit', compact('account'));

        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.social-accounts.index')
                ->withErrors(['error' => 'Social account not found.']);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'account_link' => ['required', 'url'],
            'display_order' => ['required', 'integer', 'min:1'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        try {
            $this->socialRepo->update($id, $validated, $request->file('logo'));

            return redirect()
                ->route('dashboard.social-accounts.index')
                ->with('success', 'Social account updated successfully.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update social account.'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->socialRepo->destroy($id);

            return redirect()
                ->route('dashboard.social-accounts.index')
                ->with('success', 'Social account deleted successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.social-accounts.index')
                ->withErrors(['error' => 'Failed to delete social account.']);
        }
    }
}
