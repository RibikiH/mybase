<?php
/**
 * @example Common::getConstant('SEX_MALE');
 */
return array(
    // System
    // =============================================
    // operation action
    'OPERATION_INSERT' => 1,
    'OPERATION_UPDATE' => 2,
    'OPERATION_DELETE' => 3,
    'OPERATION_RESTORE' => 4,
    // user
    'CRON_USER' => 'cron',
    'FRONTEND_USER' => 'front',
    'API_USER' => 'api',
    // delete
    'DELETE_OFF' => 0,
    'DELETE_ON' => 1,
    // sort
    'SORT_DESC' => 1,
    'SORT_ASC' => 0,
    // validate
    'MIN_PASSWORD_LENGTH' => 8,
    'MAX_PASSWORD_LENGTH' => 20,
    'TIMESTAMP_MIN' => '1970/01/01 00:00:01',
    'TIMESTAMP_MAX' => '2038/01/19 03:14:07',
    'TIMESTAMP_ZERO' => '0000-00-00 00:00:00',
    'TIMESTAMP_YEAR_MIN' => '1970',
    'TIMESTAMP_YEAR_MAX' => '2038',
    'TIMESTAMP_ERROR_NO' => 0,
    'TIMESTAMP_ERROR_MIN' => 1,
    'TIMESTAMP_ERROR_MAX' => 2,
    'TIMESTAMP_ERROR_OTHER' => 3,
    // http status code
    'HTTP_OK' => 200,
    // seconds in a day
    'SECOND_IN_DAY' => 86400,
    // Api
    // =============================================
    'API_NO_ERROR' => 0,
    'API_ERROR_DEFAULT' => 1,
    'ZIP_PATTERN' => '/\.zip$/i',
    'API_FTP_NOT_EXIST_CODE' => -1,
    'API_IMAGE_PATTERN' => '/\.(jpe?g)$/i',
    'SIMPLE_AES_PASSWORD' => '2912F5703051485B', // 16 char
    'SIMPLE_AES_IV' => '14102221AED3EF31', // 16 char
);