<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\SecurityScheme(
     *     securityScheme="bearerAuth",
     *     type="http",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     description="Enter your JWT token in the format **Bearer &lt;token&gt;**"
     * )
 */
    public function index(): JsonResponse
    {
        $products = $this->productService->all();
        return response()->json($products);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","category","price"},
     *             @OA\Property(property="name", type="string", example="iPhone 15"),
     *             @OA\Property(property="category", type="string", example="Electronics"),
     *             @OA\Property(property="price", type="number", format="float", example=999.99),
     *             @OA\Property(property="rating", type="number", format="float", example=4.5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price'    => 'required|numeric',
            'rating'   => 'nullable|numeric|min:0|max:5',
        ]);

        $data = $request->all();
        $data['user_id'] = auth('api')->id(); // Assign logged-in user
        $product = $this->productService->create($data);
        return response()->json($product, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Get product by ID",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->productService->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Update a product",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="iPhone 15 Pro"),
     *             @OA\Property(property="category", type="string", example="Electronics"),
     *             @OA\Property(property="price", type="number", format="float", example=1099.99),
     *             @OA\Property(property="rating", type="number", format="float", example=4.8)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'price'    => 'sometimes|numeric',
            'rating'   => 'sometimes|numeric|min:0|max:5',
        ]);

        $product = $this->productService->update($id, $request->all());
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Delete a product",
     *    security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $product = $this->productService->delete($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
