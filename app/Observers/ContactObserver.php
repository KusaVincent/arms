<?php

namespace App\Observers;

use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class ContactObserver
{
    public function saved(Contact $contact): void
    {
        $this->clearContactCaches();
    }

    public function deleted(Contact $contact): void
    {
        $this->clearContactCaches();
    }

    protected function clearContactCaches(): void
    {
        Cache::forget('contacts_main_sections');
        Cache::forget('footer_contacts_list');
    }
}
