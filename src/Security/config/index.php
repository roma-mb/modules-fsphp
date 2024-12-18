<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("PHP Config");

/*
 * [ allow_url_fopen | allow_url_include ] They make your application vulnerable to remote file inclusion
 * (RFI) and denial of service (DoS) attacks.
 *
 * RFI: Remote inclusion
 * DoS: Denial of Service
 */
fullStackPHPClassSession("RFI and DoS.", __LINE__);

// Change to off.
var_dump([
    'allow_url_fopen' => ini_get('allow_url_fopen'),
    'allow_url_include' => ini_get('allow_url_include')
]);


/*
 * Dos - [denial-of-service] Configurations that improve performance and help prevent denial-of-service attacks.
 * [memory_limit] 64m (small), 128m (most), and 512m or more (large) of memory allocated to PHP, A rule of thumb of 1/4 (server memory) can be applied.
 * [max_execution_time] The default is 30s, but let's aim for the minimum possible or maximum acceptable, (5s) for the user to wait.
 * []max_input_time This is the time that PHP interprets data coming in via GET or POST. The default is 60 seconds, and this is a good number due to the application's handling.
 */
fullStackPHPClassSession("Memory and time.", __LINE__);

var_dump(
    [
        'memory_get_peak_usage' => $memory = memory_get_peak_usage(),
        'memory_get_usage_m' => number_format($memory * (1024 * 1024), 2) . 'M',
    ],
    [
        'memory_limit' => ini_get('memory_limit'), // 128M
        'max_execution_time' => ini_get('max_execution_time'), // 5S
        'max_input_time' => ini_get('max_input_time'), // 60S
    ]
);


/*
 * post_max_size - Maximum limit allowed on data coming from a form
 * max_input_nesting_level - Maximum depth allowed in a vector.
 * file_uploads - Allow or not to send files in form.
 * upload_max_filesize - Maximum size in a file in the form.
 * max_file_uploads - Maximum number of files in one request.
 */
fullStackPHPClassSession("Post and files", __LINE__);

var_dump([
   'post_max_size' => ini_get('post_max_size'),
   'max_input_nesting_level' => ini_get('max_input_nesting_level'),
   'file_uploads' => ini_get('file_uploads'),
   'upload_max_filesize' => ini_get('upload_max_filesize'),
   'max_file_uploads' => ini_get('max_file_uploads')
]);


/*
 * output_buffering - limits the number of requests, improving application performance
 * by pushing all output commands to the end of the request.
 * implicit_flush - (Off) - Pushes buffering to the end of the output.
 * (On) - to download every echo, print, etc.
 * **/
fullStackPHPClassSession('Buffering', __LINE__);

var_dump([
    'output_buffering' => ini_get('output_buffering'),
    'implicit_flush' => ini_get('implicit_flush')
]);


/*
 * realpath_cache_size - PHP can maintain a cache of files used in your application to avoid reprocessing
 * and thus improve performance.
 * realpath_cache_ttl - Time in seconds of this cache.
 */
fullStackPHPClassSession('Realpath', __LINE__);

var_dump([
   'realpath_cache_size_func' => realpath_cache_size(),
   'realpath_cache_size' => ini_get('realpath_cache_size'),
    'realpath_cache_ttl' => ini_get('realpath_cache_ttl')
]);


/*
 * opcache - A bytecode cache of pre-compiled PHP scripts in shared memory
 * that eliminates the need for PHP to load and parse scripts on each request
 *
 *
 */
fullStackPHPClassSession('Realpath', __LINE__);

var_dump([
    opcache_get_configuration(),
    opcache_get_status()['scripts']
]);
