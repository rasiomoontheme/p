<?php

namespace App\Services;
use App\Exceptions\InvalidRequestException;
use Cache;

/**
 * 封装验证码服务，原有的 mews/captcha 的api验证码功能，验证码可以重复使用
 * Class CaptchaService
 * @package App\Services
 */
class CaptchaService{

    public static $captcha_expire = 60 * 5; // 过期时间 3分钟

    /**
     * 生成API验证码
     *
     * @param string $config
     * @param int $captcha_expire 过期时间，单位秒
     * @return  array
     *  $captchaParams =  [
     *      "sensitive" => true,
     *      "key" => "$2y$10$4UTAMBN0hd1V6wP3bVmbhu/PQf/y9Mz6FhFJ/VtU8CkwmRkBF8/cy",// 验证码的hash值
     *      "img" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAAkCAYAAABCKP5eAAAA",// base64后的图片
     *  ];
     */
    public static function createCodeAPI(string $config = 'default', $captcha_expire = 300)
    {
        if (!is_numeric($captcha_expire) || $captcha_expire <= 0) {
            $captcha_expire = static::$captcha_expire;
        }

        $captchaParams = app('captcha')->create($config, true);
        $captcha_key = $captchaParams['key'];
        // 缓存起来
        Cache::put("captcha:" . md5($captcha_key), 1, $captcha_expire);
        return $captchaParams;
    }

    /**
     * 生成验证码
     * @param string $captcha_code 验证码
     * @param string $captcha_key 缓存key
     * @param boolean $del_cache 通过验证是否删除缓存 true:删除：false:不删除
     * @return bool
     * @throws InvalidRequestException
     */
    public static function captchaCheckAPI($captcha_code = '', $captcha_key = '', $del_cache = true)
    {

        if (!captcha_api_check($captcha_code, $captcha_key)) {
            throw new InvalidRequestException(trans('res.api.captcha.check_err'));
        }

        if (!Cache::get("captcha:" . md5($captcha_key))) {
            throw new InvalidRequestException(trans('res.api.captcha.out_of_date'));
        }
        //var_dump('api_check:'.captcha_api_check($captcha_code, $captcha_key));exit;
        // 验证通过删除缓存
        if ($del_cache) {
            Cache::forget("captcha:" . md5($captcha_key));
        }

        return true;
    }
}