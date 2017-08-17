<?php

return [
    'environment'   => env('BRAINTREE_ENV', 'sandbox'),
    'merc_id'       => env('BRAINTREE_MERC_ID', ''),
    'public_key'    => env('BRAINTREE_PUBLIC_KEY', ''),
    'private_key'   => env('BRAINTREE_PRIVATE_KEY', '')
];