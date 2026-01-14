<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ContactUsRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    protected ContactUsRepositoryInterface $contactUsRepository;

    public function __construct(ContactUsRepositoryInterface $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }

    public function index()
    {
        $contacts = $this->contactUsRepository->paginate();
        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function show(int $id)
    {
        try {
            $contact = $this->contactUsRepository->find($id);
            
            // Mark as read if not already read
            if (!$contact->is_read) {
                $this->contactUsRepository->update($id, ['is_read' => true]);
                $contact->refresh();
            }
            
            return view('dashboard.contacts.show', compact('contact'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.contacts.index')
                             ->withErrors(['error' => 'Contact message not found or cannot be loaded.']);
        }
    }

    public function reply(Request $request, int $id)
    {
        $validated = $request->validate([
            'reply_message' => ['required', 'string']
        ]);

        try {
            $contact = $this->contactUsRepository->find($id);
            
            // Add reply using repository
            $this->contactUsRepository->addReply($id, [
                'message' => $validated['reply_message'],
                'replied_by' => Auth::id(),
            ]);

            // Send reply email
            Mail::to($contact->email)->send(
                new ContactMail([
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'subject' => $contact->subject,
                    'message' => $contact->message,
                    'replyMessage' => $validated['reply_message'],
                ])
            );

            return redirect()->route('dashboard.contacts.show', $id)
                             ->with('success', 'Reply sent successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to send reply.'])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->contactUsRepository->destroy($id);

            return redirect()->route('dashboard.contacts.index')
                             ->with('success', 'Contact message deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.contacts.index')
                             ->withErrors(['error' => 'Failed to delete contact message.']);
        }
    }
}