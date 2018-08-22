<?php

namespace App\Exceptions\Adapters\Aliexpress;

use Exception;
use App\Exceptions\BaseException;


/**
 * Adpter Exception
 */
class AliexpressCategoriesAdapterException extends BaseException
{
    const INVALID_CATEGORY_URL      = 'Failed to parse url2id(), invalid url stracutre given, the \'category\' offset not found.';
    const INVALID_CATEGORY_URL_ID   = 'Failed to parse url2id(), not numeric id found in the expected id offset.';
    const INVALID_CATEGORY_URL_PATH = 'Failed to parse url2id(), unexpected path value.';
}
