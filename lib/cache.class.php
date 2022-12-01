<?php

/**
 * cache class . used to cache a file or part of a file
 * @author Mohammad A.Baydoun <momito_bay@hotmail.com>
 * @copyright copyright (c) copyright 2011
 * @license GNU Public Licence (GPL)
 */

/**
 * @version 1.0  support file and part file caching
 * @example
 * ***file caching***
 * $cache=new cache();
 * $cache->start_cache();
 * place data in between example (html /php echo of your output)
 * $cache->end_cache();
 *
 *  * ***part file caching***
 * $cache=new cache();
 * $cache->start_cache($id); where $id is the part you want to cache it 
 * place data in between example (html /php echo of your output)
 * $cache->end_cache();
 */
class cache {

    /**
     *
     * @var <string>
     */
    private static $cache_dir = null;
    /**
     *
     * @var <string>
     */
    private static $cache_reset_field = "mab";
    /**
     *
     * @var <array>
     */
    private $cache_field = array();
    /**
     *
     * @var <integer> 900 seconds means 15 minute
     */
    private $cache_time = 900;
    /**
     *
     * @var <string>
     */
    private $cache_file = null;
    private $cache_file_short = null;
    private $log_file = NULL;
    private $log_data = NULL;

    /**
     * 
     */
    public function __construct() {
        if (!self::$cache_dir)
            $this->set_cache_dir(getcwd() . "/.cache/");
    }

    public function get_cachefile() {
        return $this->cache_file_short;
    }

    /**
     *
     * @param <string> $dir
     * @return cache
     */
    public function set_cache_dir($dir) {
        if (!is_dir($dir))
            @mkdir($dir, 0777);
        self::$cache_dir = $dir;
        return $this;
    }

    /**
     *
     * @param <string> $field
     * @return cache 
     */
    public function set_cache_reset_field($field) {
        self::$cache_reset_field = $field;
        return $this;
    }

    /**
     *
     * @param <string> $field
     * @param <string> $value
     * @return cache 
     */
    public function add_cache_field($field, $value) {
        $this->cache_field[] = "{$field}={$value}";
        return $this;
    }

    /**
     *
     * @return <string>
     */
    public function get_cache_field() {
        return @implode("&", $this->cache_field);
    }

    /**
     *
     * @param <integer> $time
     * @return cache 
     */
    public function set_cache_time($time) {
        $this->cache_time = $time;
        return $this;
    }

    /**
     *
     * @return <integer>
     */
    public function get_cache_time() {
        return $this->cache_time;
    }

    /**
     *
     * @return <bool>
     */
    public function start_cache($cache_id=null) {

        /**
         * reset all caches if the cache reset field is called
         */
        if (isset($_GET[self::$cache_reset_field])) {
            /**
             * reset the time
             */
            $this->set_cache_time(0);

            /**
             * means file and not part of file
             */
            if (!$cache_id) {
                /**
                 * reset string
                 */
                $reset_field = self::$cache_reset_field . "={$_GET[self::$cache_reset_field]}";
                /**
                 * reset in case of multi parameters exist;
                 */
                $_SERVER['QUERY_STRING'] = preg_replace(array("/&{$reset_field}/", "/{$reset_field}&/", "/{$reset_field}/"), array("", "", ""), $_SERVER['QUERY_STRING']);
            }
        }

        $this->log_data = $_SERVER['QUERY_STRING'];
        /**
         * set the full path of a cache file
         */
        $this->cache_file_short = md5(($cache_id ? $cache_id :
                                $_SERVER['SCRIPT_NAME'] . $_SERVER['QUERY_STRING']
                        ) . $this->get_cache_field());

        $this->cache_file = self::$cache_dir . $this->cache_file_short;
        $this->log_file   = self::$cache_dir . "00000-LogData.txt";

        /**
         * check that the file exists in fullfill the time set for caching
         * return true in order to start caching
         */
        if (@file_exists($this->cache_file)) // && 
//                 (time() - $this->get_cache_time() < @filemtime($this->cache_file))) 
        {
            echo file_get_contents($this->cache_file);

            /**
             * if it is a file
             */
            if (!$cache_id)
                exit;
        } else {
            /**
             * start buffering the data
             */
            ob_start();
            return true;
        }
    }

    public function end_cache() {

        /**
         * get the output data of the buffer
         */
        $cache_content = ob_get_clean();

        /**
         * save the data to a file in order to use it to check for validate caching time
         */
        $cache_file = @fopen($this->cache_file, 'w');
        @fwrite($cache_file, $cache_content);
        @fclose($cache_file);

        $log_file = @fopen($this->log_file, 'a');
        $log_data = $this->cache_file_short . " - " .$this->log_data;
        @fwrite($log_file, $log_data . "\n");
        @fclose($log_file);

        /**
         * output the data
         */
        echo $cache_content;
    }

}

?>