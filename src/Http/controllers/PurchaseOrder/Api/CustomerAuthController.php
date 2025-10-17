<?php

namespace PurchaseOrder\Http\Controllers\PurchaseOrder\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use PurchaseOrder\Http\Requests\PurchaseOrder\RegisterCustomerRequest;
use PurchaseOrder\Http\Requests\PurchaseOrder\LoginCustomerRequest;
use App\Models\PurchaseOrder\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PurchaseOrder\Http\Requests\PurchaseOrder\UpdateCustomerRequest;
use PurchaseOrder\Http\Resources\OrderCollection;
use PurchaseOrder\Http\Resources\OrderResource;
use App\Models\PurchaseOrder\Order;

class CustomerAuthController extends Controller
{
    public function register(RegisterCustomerRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $customer = Customer::create($data);

        $token = null;
        // If the Customer model supports API tokens, revoke existing and issue a new one
        if (method_exists($customer, 'tokens') && method_exists($customer, 'createToken')) {
            try {
                $customer->tokens()->delete();
            } catch (\Throwable $e) {
                // ignore if tokens relation isn't available
            }

            $token = $customer->createToken('customer-token')->plainTextToken;
        }

        return response()->json(['user' => $customer, 'token' => $token], 201);
    }

    public function login(LoginCustomerRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::where('email', $data['email'])->first();

        if (!$customer || !Hash::check($data['password'], $customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = null;
        if (method_exists($customer, 'tokens') && method_exists($customer, 'createToken')) {
            try {
                $customer->tokens()->delete();
            } catch (\Throwable $e) {
                // ignore
            }

            $token = $customer->createToken('customer-token')->plainTextToken;
        }

        return response()->json(['user' => $customer, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        try {
            $current = null;
            if (method_exists($user, 'currentAccessToken')) {
                $current = $user->currentAccessToken();
            }

            if ($current) {
                $current->delete();
                return response()->json(['message' => 'Logged out']);
            }
        } catch (\Throwable $e) {
            // fall through
        }

        return response()->json(['message' => 'No active token found'], 400);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        return response()->json($user);
    }

    public function update(UpdateCustomerRequest $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $data = $request->validated();
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function orders(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $orders = Order::where('customer_id', $user->id)->with(['items', 'payments'])->paginate(15);
        return new OrderCollection($orders);
    }
}
