<?php

namespace Omnipay\Twispay;

class Decrypter
{
    public static function decrypt(string $encrypted, $key)
    {
        if (strpos($encrypted, ',') !== false) {
            $encryptedParts = explode(',', $encrypted, 2);
            $iv = base64_decode($encryptedParts[0]);
            if ($iv === false) {
                throw new \Exception('Invalid encryption iv');
            }
            $encrypted = base64_decode($encryptedParts[1]);
            if ($encrypted === false) {
                throw new \Exception('Invalid encrypted data');
            }
            $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
            if ($decrypted === false) {
                throw new \Exception('Cannot decrypt data');
            }

            return $decrypted;
        }

        return null;

    }
}
