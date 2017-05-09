<?php

namespace Omnipay\Twispay;

class Checksum
{
    public static function generate(array $data, string $key)
    {
        unset($data['checksum']);
        self::recursiveKeySort($data);
        $query = http_build_query($data);
        $encoded = hash_hmac('sha512', $query, $key, true);

        return base64_encode($encoded);
    }

    /**
     * @param array $data
     */
    private static function recursiveKeySort(array &$data)
    {
        ksort($data, SORT_STRING);
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                self::recursiveKeySort($data[$key]);
            }
        }
    }

}
