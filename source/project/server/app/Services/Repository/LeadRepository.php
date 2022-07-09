<?php

namespace App\Services\Repository;

use AmoCRM\Models\LeadModel;
use App\Models\Lead;
use Exception;
use Illuminate\Support\Facades\DB;

class LeadRepository
{
    public function get(string|int $leadId): Lead|null
    {
        return Lead::where('lead_id', $leadId)->first();
    }

    public function addLead(LeadModel $data): void
    {
        DB::beginTransaction();

        try {
            $model = new Lead();
            $model->lead_id = $data->getId();
            $model->name = $data->getName();
            $model->lead_data = json_encode($data->toArray(), JSON_UNESCAPED_UNICODE);
            $model->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
