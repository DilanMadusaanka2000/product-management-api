<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Product Dashboard API",
 *     description="Swagger API documentation for Product Dashboard",
 *     @OA\Contact(email="support@example.com")
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class SwaggerInfo
{
    // Just a container for Swagger info; no code needed
}
