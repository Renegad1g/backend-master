<?php

namespace App\Storage;

class Helper
{
    //public const STORAGE_KEY = 'product';

    public function differenceOfData(string $oldData, string $newData): array
    {
        $return = [];
        $oldData = explode(' ', $oldData);
        $newData = explode(' ', $newData);
        foreach($oldData as $key => $value) {
            if($value != $newData[$key]) {
                $return[$key] = $newData[$key];
            }
        }

        return $return;
    }
}