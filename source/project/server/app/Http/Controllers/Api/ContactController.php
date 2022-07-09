<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContactService;
use App\Services\Credentials;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function getInfo()
    {
        return response()->json(
            Credentials::getApiClient()->contacts()->get()
        );
    }

    public function setOne(Request $req)
    {
        try {
            $this->validate($req, [
                'name' => 'required|min:3|max:50',
            ]);
            
            $data = [
                'name' => $req['name'],
            ];
            return response()->json(
                $this->contactService->createContact(...$data)->toArray(), 200
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }
}