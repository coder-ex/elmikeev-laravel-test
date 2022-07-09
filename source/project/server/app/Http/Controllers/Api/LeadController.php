<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Credentials;
use App\Services\LeadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class LeadController extends Controller
{
    private $leadService;

    public function __construct()
    {
        $this->leadService = new LeadService();
    }

    public function amoCRM(Request $req)
    {
        $leads = $req['status'];
        File::put(
            storage_path('app/leads.json'),
            json_encode($leads, JSON_PRETTY_PRINT)
        );

        $data = [
            'leadId' => $leads[0]['id'],
            'nameFilds' => [
                     "A", "B", "C"
                 ]
        ];

        return response()->json(
            $this->leadService->oneUpdate(...$data)->toArray(),
            200
        );
    }

    public function getInfo()
    {
        try {
            return response()->json(
                Credentials::getApiClient()->leads()->get(),
                200
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function oneUpdate(Request $req)
    {
        try {
            $this->validate($req, [
                'lead_id' => 'required|min:3|max:6',
            ]);

            $data = [
                'leadId' => $req['lead_id'],
                'nameFilds' => [
                    "A", "B", "C"
                ]   //$req['name_filds']
            ];
            return response()->json(
                $this->leadService->oneUpdate(...$data)->toArray(),
                200
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }

    public function setLeadOne(Request $req)
    {
        try {
            $this->validate($req, [
                'name' => 'required|min:3|max:50',
            ]);

            $data = [
                'name' => $req['name'],
            ];
            return response()->json(
                $this->leadService->createLead(...$data)->toArray(),
                200
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], isset($e->status) ? $e->status : 401);
        }
    }
}
