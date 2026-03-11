<?php
use OpenApi\Attributes as OA;
/**
 * @OA\Info(
 *     title="Product Dashboard API",
 *     version="1.0.0",
 *     description="REST API"
 * )
 * @OA\Server(
 *     url="/api",
 *     description="API Server"
 * )
 */
class A {
    /**
     * @OA\Get(path="/x", @OA\Response(response="200", description="ok"))
     */
    public function x() {}
}
