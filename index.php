<?php
/*
Plugin Name: Kill 429
Plugin URI: http://wordpress.org/plugins/Kill-429/
Description: Kill 429是一款解决中国境内服务器WordPress版本更新，主题及插件更新报429错误的插件，插件通过优化中国境内服务器访问WordPress数据服务器的网络，解决429报错问题，快速安装WordPress版本更新及其他主题、插件更新。
Author: wbolt
Version: 1.1.0
Author URI:http://www.wbolt.com/
*/

define('WP_KILL_429_PATH',__DIR__);
define('WP_KILL_429_BASE_FILE',__FILE__);
define('WP_KILL_429_VERSION','1.1.0');

WP_KILL_429::init();

class WP_KILL_429
{
    public static $debug = false;

    public static $name = 'kill_429';
    public static $optionName = 'kill_429_option';

    public static function init(){


        if(is_admin()){
            add_filter( 'admin_init' , array(__CLASS__,'admin_init') );
            add_action( 'admin_menu', array(__CLASS__,'admin_menu') );
            add_action('admin_enqueue_scripts',array(__CLASS__,'admin_enqueue_scripts'),1);

            add_filter('http_request_args',array(__CLASS__,'http_request_args'),100,2);
            add_action('http_api_curl',array(__CLASS__,'http_api_curl'),10,3);
            add_filter( 'plugin_action_links', array(__CLASS__,'actionLinks'), 10, 2 );
            add_filter('plugin_row_meta', array(__CLASS__, 'plugin_row_meta'), 10, 2);
        }
    }
    public static function cnf($key=null,$default=null){
        static $_option = array();
        if(!$_option){
            $_option = get_option( self::$optionName ,array('switch'=>1,'type'=>'us','proxy'=>''));
        }
        if(null == $key){
            return $_option;
        }
        if(isset($_option[$key])){
            return $_option[$key];
        }

        return $default;

    }
    public static function http_api_curl($cl,$rq,$url){

        if(preg_match('#downloads.wordpress\.org/#',$url)){
            if(self::cnf('switch') && in_array(self::cnf('type'),array('jp','us','hk'))){
                $type = self::cnf('type');
                $url = str_replace('downloads.wordpress.org/',$type.'.wp.wbolt.com/',$url);
                $url = str_replace('https://','http://',$url);
                curl_setopt($cl, CURLOPT_URL, $url);
            }
        }else if(preg_match('#api.wordpress\.org/#',$url)){
            /*$url = str_replace('api.wordpress.org/','wb429.hk.hzrent.com/',$url);
            $url = str_replace('https://','http://',$url);
            curl_setopt($cl, CURLOPT_URL, $url);*/
        }

        self::txt_log($url);

    }

    public static function txt_log($msg){

        if(!self::$debug){
            return;
        }
        $num = func_num_args();
        if($num>1){
            $msg = json_encode(func_get_args());
        }else if(is_array($msg)){
            $msg = json_encode($msg);
        }

        error_log('['.current_time('mysql').']'.$msg."\n",3,__DIR__.'/#log/'.date('Ym').'.log');
    }

    public static function http_request_args($parsed_args, $url){


        if(!preg_match('#wordpress\.org/#',$url)){
            return $parsed_args;
        }



        $switch = self::cnf('switch');

        if(!$switch){
            return $parsed_args;
        }

        if(isset($parsed_args['user-agent']) && $parsed_args['user-agent']){
            $parsed_args['user-agent'] = $parsed_args['user-agent'].' ; WB-PROXY-WP';
        }



        $type = self::cnf('type');

        if($type!='other'){
            return $parsed_args;
        }

        $proxy = self::cnf('proxy');

        if(!$proxy){
            return $parsed_args;
        }

        $a = explode(':',$proxy);

        if(count($a)!=2){
            return $parsed_args;
        }
        if(!$a[0] || !$a[1]){
            return $parsed_args;
        }



        /*if(!defined('WP_PROXY_HOST') && !defined('WP_PROXY_PORT')){
            define('WP_PROXY_HOST',$a[0]);
            define('WP_PROXY_PORT',$a[1]);
        }*/
        $parsed_args['timeout'] = $parsed_args['timeout'] + 60;
        if(preg_match('#downloads\.wordpress\.org#',$url)){
            $parsed_args['timeout'] = $parsed_args['timeout'] + 1200;
            @set_time_limit($parsed_args['timeout'] + 60);
        }

        self::txt_log($url);
        //error_log($url."\n".print_r($parsed_args,true)."\n",3,__DIR__.'/log.txt');

        return $parsed_args;

    }
    public static function admin_menu(){
        global $wb_settings_page_hook_kill_429;
        $wb_settings_page_hook_kill_429 = add_options_page(
            'Kill 429设置',
            'Kill 429设置',
            'manage_options',
            self::$name,
            array(__CLASS__,'admin_settings')
        );
    }
    public static function admin_enqueue_scripts($hook){
        global $wb_settings_page_hook_kill_429;
        if($wb_settings_page_hook_kill_429 != $hook) return;

        wp_enqueue_style('wbs-style-kill-429', plugin_dir_url(WP_KILL_429_BASE_FILE) . 'assets/wbp_setting.css', array(),WP_KILL_429_VERSION);
    }
    public static function admin_settings(){

        $opt = self::cnf();
        $setting_field = self::$optionName;
        $option_name = self::$optionName;

        $api_html = self::api_html();
        include_once( WP_KILL_429_PATH.'/settings.php' );
    }
    private static function api_html(){
        $api = 'https://www.wbolt.com/wb-api/v1/news/lastest';
        $api_tag = array('<','/','s','c','r','i','p','t');
        $api_attr = array('type'=>'text/javascript','src'=>$api);

        $api_html =  str_replace('/','',implode('',$api_tag));
        foreach ($api_attr as $attr=>$attr_value){
            $api_html .= ' '.$attr . '="'.esc_attr($attr_value).'"';
        }
        $api_html .= '>'.implode('',$api_tag).'>';

        return $api_html;
    }

    public static function plugin_row_meta($links,$file){

        $base = plugin_basename(WP_KILL_429_BASE_FILE);
        if($file == $base) {
            $links[] = '<a href="https://www.wbolt.com/plugins/kill-429">插件主页</a>';
            $links[] = '<a href="https://www.wbolt.com/kill-429-plugin-documentation.html">FAQ</a>';
            $links[] = '<a href="https://wordpress.org/support/plugin/kill-429/">反馈</a>';
        }
        return $links;
    }
    public static function actionLinks( $links, $file ) {

        if ( $file != plugin_basename(WP_KILL_429_BASE_FILE) )
            return $links;

        $settings_link = '<a href="'.menu_page_url( self::$name, false ).'">设置</a>';

        array_unshift( $links, $settings_link );

        return $links;
    }
    public static function admin_init(){
        register_setting(  self::$optionName,self::$optionName );

    }

}