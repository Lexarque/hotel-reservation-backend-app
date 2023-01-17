<?php

namespace App\Shareds;

use Illuminate\Http\RedirectResponse;

class ControllerRedirect
{

    /**
     * This function is used to redirect the controller if the operation is a success
     * 
     * @param string $path
     * @param string $message
     * @return RedirectResponse
     */
    public static function responseSuccess(string $path, string $message): RedirectResponse
    {
        return redirect($path)->with('success', [
            'status' => 200,
            'message' => $message
        ]);
    }
}
