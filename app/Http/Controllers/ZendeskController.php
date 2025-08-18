<?php
namespace App\Http\Controllers;

use Log;
use App\Http\Requests\ZendeskSupportRequest;
use App\Services\ZendeskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;


class ZendeskController extends Controller
{
    private ZendeskService $zendeskService;

    public function __construct(ZendeskService $zendeskService)
    {
        $this->zendeskService = $zendeskService;
    }

    /**
     * Show support form
     */
    public function index(): View
    {
        return view('creatives_test.support.index');
    }
    public function submit(ZendeskSupportRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $data = $request->validated();
            
            // Add attachment if present
            if ($request->hasFile('attachment')) {
                $data['attachment'] = $request->file('attachment');
            }

            $ticket = $this->zendeskService->createTicket($data);

            $message = 'Your support ticket has been created successfully.';

            // Return JSON for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'ticket_id' => $ticket['id']
                ]);
            }

            // Redirect with success message for regular form submission
            return redirect()->back()->with('success', $message);

        } catch (Exception $e) {
            $errorMessage = 'Failed to create support ticket. Please try again.';

            // Return JSON error for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'error' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }

            // Redirect with error message for regular form submission
            return redirect()->back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }
}
