<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * Modify form data before creating a new record.
     *
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Add the current user's ID to the created_by and updated_by fields
        $data['created_by'] = auth()->id();  // Assuming the user is authenticated
        $data['updated_by'] = auth()->id();  // Assuming the user is authenticated

        return $data;
    }
}
