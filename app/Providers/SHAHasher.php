<?php

namespace App\Providers;

use Illuminate\Contracts\Hashing\Hasher;

class SHAHasher implements Hasher
{
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }
    public function make($value, array $options = array())
    {
      // return hash('sha1', $value);
      // Add salt and run as SHA256
      return hash_hmac('sha256', $value, env('HASH_KEY'));
    }
    public function check($value, $hashedValue, array $options = array())
    {
      return $this->make($value) === $hashedValue;
    }
    public function needsRehash($hashedValue, array $options = array())
    {
      return false;
    }
}
