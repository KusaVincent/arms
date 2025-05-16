<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

final class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'icon' => 'phone',
                'label' => 'Phone Number',
                'link' => 'tel:+254798749323',
                'link_text' => '+2547 98 749 323',
            ],
            [
                'icon' => 'whatsapp',
                'label' => 'WhatsApp Contacts',
                'link' => 'https://wa.me/+254798749323',
                'link_text' => '+2547 98 749 323',
            ],
            [
                'icon' => 'envelope',
                'label' => 'Email Address',
                'link' => 'mailto:info@rentalskonekt.com',
                'link_text' => 'info@rentalskonekt.com',
                'section' => 'contact',
            ],
            [
                'icon' => 'envelope',
                'label' => 'Support Email Address',
                'link' => 'mailto:support@rentalskonekt.com',
                'link_text' => 'support@rentalskonekt.com',
                'section' => 'footer',
            ],
            [
                'icon' => 'facebook-f',
                'label' => 'Facebook',
                'link' => 'https://www.facebook.com',
                'link_text' => 'facebook.com',
                'section' => 'footer',
            ],
            [
                'icon' => 'twitter',
                'label' => 'X',
                'link' => 'https://www.x.com',
                'link_text' => 'x',
                'section' => 'footer',
            ],
            [
                'icon' => 'instagram',
                'label' => 'Instagram',
                'link' => 'https://www.instagram.com',
                'link_text' => 'https://www.instagram.com',
                'section' => 'footer',
            ],
            [
                'icon' => 'linkedin',
                'label' => 'Linkedin',
                'link' => 'https://www.linkedin.com',
                'link_text' => 'https://www.linkedin.com',
                'section' => 'footer',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
