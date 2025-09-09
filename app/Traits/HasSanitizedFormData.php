<?php

namespace App\Traits;

use App\Helpers\LogHelper;

trait HasSanitizedFormData
{
    /**
     * Override in the page class to exclude specific keys
     */
    protected function getSanitizeExcludedKeys(): array
    {
        return ['body_html'];
    }

    /**
     * Tags allowed in sanitized strings
     */
    protected function getAllowedHtmlTags(): string
    {
        return '<b><i><u><strong><em><a><p><br><ul><ol><li>';
    }

    /**
     * Returns the sanitized version of the form data array
     */
    protected function sanitizeInput(array $data): array
    {
        $excluded = $this->getSanitizeExcludedKeys();
        $sanitizedFields = [];

        $cleaned = collect($data)->map(function ($value, $key) use ($excluded, &$sanitizedFields) {
            if (is_string($value)) {
                $original = $value;

                $value = trim($value);

                if (str_contains($key, 'email')) {
                    $value = strtolower($value);
                }

                if (! in_array($key, $excluded)) {
                    $value = strip_tags($value, $this->getAllowedHtmlTags());

                    if ($value !== $original) {
                        $sanitizedFields[] = $key;
                    }
                }

                return $value;
            }

            if (is_array($value)) {
                return $this->sanitizeInput($value);
            }

            return $value;
        })->toArray();

        if ($sanitizedFields !== []) {
            LogHelper::info(
                message: 'Fields sanitized successfully.',
                request: request(),
                additionalData: [
                    'fields' => $sanitizedFields,
                    'user_id' => auth()->id(),
                    'class' => static::class,
                ]
            );
        }

        return $cleaned;
    }
}
