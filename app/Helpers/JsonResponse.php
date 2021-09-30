<?php
namespace App\Helpers;

class JsonResponse
{
    const MSG_ADDED_SUCCESSFULLY = 'added successfully';
    const MSG_UPDATED_SUCCESSFULLY = "updated successfully";
    const MSG_DELETED_SUCCESSFULLY = "deleted successfully";
    const MSG_NOT_ALLOWED = "not allowed";
    const MSG_NOT_FOUND = "not found";
    const MSG_SUCCESS = "success";
    const MSG_FAILED = "failed";   

    public static function respondSuccess($message, $content = null, $status = 200)
    {
        return response()->json([
            'result' => trans(self::MSG_SUCCESS),
            'content' => $content,
            'message' => $message,
            'status' => $status
        ]);
    }

    public static function respondError($message, $status = 500)
    {
        return response()->json([
            'result' => trans(self::MSG_FAILED),
            'content' => null,
            'message' => $message,
            'status' => $status
        ], $status);
    }   
}