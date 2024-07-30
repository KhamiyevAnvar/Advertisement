<?php


namespace App\SelectData;

class AdvertisementStatus
{
    public static function getStatus($status = null)
    {
        $data = [
            [
                'id' => 3,
                'name' => 'Qebul edilmedi'
            ],
            [
                'id' => 1,
                'name' => 'Gozlemede'
            ],
            [
                'id' => 2,
                'name' => 'Tesdiq'
            ]

        ];

        if ($status) {
            foreach ($data as $datum) {
                if ($datum['id'] == $status) {
                    return $datum['name'];
                }
            }
        }

        return  null;
    }
};
