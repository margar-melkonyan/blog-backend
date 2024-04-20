<?php

namespace App\Http\Controllers\Users;

use App\DTO\Users\UserRequestDto;
use App\DTO\Users\UserSimpleDto;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Services\Users\UserService;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function index(): Paginator|Enumerable|array|Collection|PaginatedDataCollection|LazyCollection|AbstractCursorPaginator|CursorPaginatedDataCollection|DataCollection|AbstractPaginator|CursorPaginator
    {
        return $this->userService->index();
    }

    public function show(User $user): UserSimpleDto
    {
        return $this->userService->show($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequestDto $request, User $user): JsonResponse
    {
        return response()->json(
            [
                'id' => $this->userService->update(UserRequestDto::from($request), $user)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        return response()->json([
            'success' => $this->userService->delete($user)
        ]);
    }
}