<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponseTrait
{
    // 默认状态码 200
    protected $statusCode = FoundationResponse::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respond($data, $header = [])
    {
        return response()->json($data, $this->getStatusCode(), $header)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function message($message, $status = "success")
    {
        return $this->status($status, [], null, $message);
        // return $this->status($status, [
        // 	'message' => $message
        // ]);
    }

    public function messageWithCode($message, $code, $status = "success")
    {
        return $this->status($status, [], $code, $message);
    }

    public function internalError($message = "Internal Error!")
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function success($data, $message = '', $status = "success")
    {
        return $this->status($status, $data, null, $message);
    }

    public function successWithUrl($data, $message = '', $url, $status = "success")
    {
        $data['url'] = $url;
        return $this->status($status, $data, null, $message);
    }

    public function successWithCode($data, $message, $code, $status = "success")
    {
        return $this->status($status, $data, $code, $message);
    }

    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error', $data = [])
    {
        return $this->status($status, $data, $code, $message);
    }

    /**
     * 返回格式化的响应信息
     *
     * @param string $status
     * @param array $data
     * @param integer $code
     * @param string $message
     * @return void
     * @Description
     * @example
     * @since
     * @date 2020-02-22
     */
    public function status($status, array $data, $code = null, $message = '')
    {
        if ($code) {
            $this->setStatusCode($code);
        }
        $status = [
            'status' => $status,
            'code' => $this->statusCode,
            'message' => $message
        ];

        $data = array_merge($status, $data);
        return $this->respond($data);
    }


    /**
     * Page Not Found 404
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message, Foundationresponse::HTTP_NOT_FOUND);
    }
}
