<?php

namespace App\Services;

use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CustomFieldsValues\NumericCustomFieldValuesModel;
use AmoCRM\Models\LeadModel;
use App\Services\Repository\LeadRepository;
use Exception;
use Illuminate\Support\Facades\File;


class LeadService
{
    private $leadRepository;

    public function __construct()
    {
        $this->leadRepository = new LeadRepository();
    }

    public function oneUpdate(string|int $leadId, array $nameFilds)
    {
        $apiClient = Credentials::getApiClient();

        $leads = $apiClient->leads()->get();
        //dd($leads);

        //--- получим все поля сделки
        $customFieldsService = $apiClient->customFields(EntityTypesInterface::LEADS);   // сервис кастом полей для сделок

        try {
            //--- получим поля
            $filds = [];
            foreach ($customFieldsService->get() as $key => $value) {
                foreach ($nameFilds as $k => $val) {
                    if ($value->name === $val) {
                        $filds[] = $value;
                    }
                }
            }

            //--- пройдемся по коллекции сделок и обновим все найденные сделки
            /** @var LeadModel $lead */
            foreach ($leads as $lead) {
                if ($lead->id != $leadId) continue;

                //--- получим коллекцию значений полей сделки
                $customFields = $lead->getCustomFieldsValues();

                //--- получим значение поля по его ID
                $valueA = $valueB = $valueC = 0;
                if (!empty($customFields)) {
                    foreach ($filds as $fild) {
                        $textField = $customFields->getBy('fieldId', $fild->id);
                        if ($textField) {
                            if ($fild->name === 'A') {
                                $textFieldValueCollection = $textField->getValues();
                                $valueA = $textFieldValueCollection[0]->value;
                            } elseif ($fild->name === 'B') {
                                $textFieldValueCollection = $textField->getValues();
                                $valueB = $textFieldValueCollection[0]->value;
                            } elseif ($fild->name === 'C') {
                                $textFieldValueCollection = $textField->getValues();
                                $valueC = $textFieldValueCollection[0]->value;
                            }
                        }
                    }

                    $valueB += $valueA + $valueC;   // посчитаем

                    //--- ниже зададим/обновим значения для полей типа дата-время и день рождения
                    foreach ($customFields as $fild) {
                        if ($fild instanceof NumericCustomFieldValuesModel) {
                            $customFieldValue = $fild->getValues()->first();

                            //--- найдем поле B и обновим данные
                            if ($fild->getFieldName() === 'B') {
                                $customFieldValue->setValue($valueB);
                                break;
                            }
                        }
                    }
                }

                $lead->setCustomFieldsValues($customFields);
            }

            $apiClient->leads()->update($leads);    // обновим

            //--- получим данные сделки
            $lead = $apiClient->leads()->getOne($leadId);
        } catch (AmoCRMApiException $e) {
            //throw new Exception($e->getTitle(), $e->getErrorCode(), $e->getLastRequestInfo());
            dd($e);
        }

        //--- test
        File::put(
            storage_path('app/leads_servise.json'),
            json_encode($leads, JSON_PRETTY_PRINT)
        );
        //--- end test

        //---
        return $lead;
    }

    public function createLead(string $name): LeadModel
    {
        $apiClient = Credentials::getApiClient();

        //--- создадим сделку
        $lead = new LeadModel();
        $lead->setName($name);

        try {
            $lead = $apiClient->leads()->addOne($lead);
            if(is_null($this->leadRepository->get($lead->getId()))){
                $this->leadRepository->addLead($lead);
            }
        } catch (AmoCRMApiException $e) {
            //throw new Exception($e->getTitle(), $e->getErrorCode(), $e->getLastRequestInfo());
            dd($e);
        }
        //---
        return $lead;
    }
}
