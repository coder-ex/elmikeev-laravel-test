<?php

namespace App\Services;

use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use Exception;

class ContactService
{
    public function createContact(string $name): ContactModel
    {
        //--- создадим контакт
        $contact = new ContactModel();
        $contact->setName($name);

        $apiClient = Credentials::getApiClient();

        try {
            $contactModel = $apiClient->contacts()->addOne($contact);
        } catch (AmoCRMApiException $e) {
            printError($e);
            die;
        }
        //---
        return $contactModel;
    }
}