<?php


namespace App\Http\Support\Response;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

final class ApiResponse
{
    /**
     * Response status code
     * @var int
     */
    private int $status_code;

    /**
     * Response Headers
     * @var array
     */
    private array $headers;

    /**
     * Response Data
     * @var array
     */
    private array $data;

    /**
     * Static instance for singleton
     *
     * @param int $status_code
     * @param array $headers
     * @param array $data
     */
    public function __construct($status_code = 200, $headers = [], $data = [])
    {
        $this->status_code = $status_code;
        $this->headers = $headers;
        $this->data = $data;
    }

    /**
     * Default success Response
     * @return Application|ResponseFactory|Response
     */
    public function successResponse()
    {
        return response($this->data);
    }

    /**
     * Generic error response
     * @param $status_code
     * @param $headers
     * @return Application|ResponseFactory|Response
     */
    private function errorResponse($status_code, $headers)
    {
        return response($this->data, $status_code, $headers);
    }


    /**
     * Not Found Error response
     * @return Application|ResponseFactory|Response
     */
    public function notFoundResponse()
    {
        return $this->errorResponse(404, []);
    }

    /**
     * Server error response
     * @return Application|ResponseFactory|Response
     */
    public function serverErrorResponse()
    {
        return $this->errorResponse(500,[]);
    }

    /**
     * UnAuthorized response
     * @return Application|ResponseFactory|Response
     */
    public function unAuthorizedResponse()
    {
        return $this->errorResponse(401, []);
    }

    /**
     * Magic get function
     * @param $value
     * @return mixed
     */
    public function __get($value)
    {
        return $this->$value;
    }

    /**
     * Magic Set
     * @param $param
     * @param $value
     */
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
}
