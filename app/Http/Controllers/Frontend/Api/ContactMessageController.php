<?php

namespace App\Http\Controllers\Frontend\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\ContactUsRepositoryInterface;

class ContactMessageController extends Controller
{
    protected ContactUsRepositoryInterface $contactUsRepository;

    public function __construct(ContactUsRepositoryInterface $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'subject' => ['required','string','max:255'],
            'message' => ['required','string','max:5000'],
        ]);
        try {
            $this->contactUsRepository->create($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Contact message sent successfully',
        ], 201);
    }
}
