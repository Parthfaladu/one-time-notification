<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse, RedirectResponse};
use Illuminate\View\View;
use App\Services\Interfaces\IUserService;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use App\Http\Requests\UpdateUserSettingsRequest;
use DataTables;

class UserController extends Controller
{
    protected $userService;

    /**
     * Undocumented function
     *
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * user list view
     *
     * @param Request $request
     * @return View
     */
    public function userList(Request $request): View
    {
        return view("user.user-list");
    }

    /**
     * user list for datatable
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function userDt(Request $request): JsonResponse
    {
        $users = $this->userService->users();

        return Datatables::of($users)->make(true);
    }

    /**
     * user settings view
     *
     * @param Request $request
     * @param string $userId
     * @return View
     */
    public function userSettings(Request $request, string $userId): View
    {
        $userWithNotification = $this->userService->userWithNotification($userId);
        $user = new UserResource($userWithNotification);

        return view("user.settings", compact("user"));
    }

    /**
     * update user settings
     *
     * @param UpdateUserSettingsRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updateUserSettings(UpdateUserSettingsRequest $request, User $user): RedirectResponse
    {
        $userWithNotification = $this->userService->updateUserSettings($request, $user);

        return redirect()->back();
    }

    /**
     * user dashboard
     *
     * @param string $userId
     * @return View
     */
    public function userDashboard(string $userId): View
    {
        $userWithNotification = $this->userService->userWithNotification($userId);
        $user = new UserResource($userWithNotification);

        return view("user.dashboard", compact("user"));
    }
}
