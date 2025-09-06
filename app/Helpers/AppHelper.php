<?php

namespace App\Helpers;

use JsonException;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\Settings\GeneralSettings;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification as FilamentNotification;

class AppHelper
{


    static function checkRateLimit(string $key, int $maxAttempts = 3, int $decaySeconds = 60): ?JsonResponse
    {
        $limiter = app(RateLimiter::class);
        if ($limiter->tooManyAttempts($key, $maxAttempts)) {
            $seconds = $limiter->availableIn($key);
            return response()->json([
                'message' => 'The given data was invalid.',
                'data' => [
                    'seconds' => $seconds,
                    'message' => [
                        trans('auth.throttle', [
                            'seconds' => $seconds,
                            'minutes' => ceil($seconds / 60),
                        ]),
                    ],
                ],
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }
        $limiter->hit($key, $decaySeconds);
        return null;
    }

    static function uploadFiles(string $path, $file): string
    {
        if ($file) {
            $path = $file->store($path, 'public');
        }
        return $path;
    }


    public static function uploadImageSeeder($name, $path): string
    {
        $sourcePath = public_path($name);

        if (!file_exists($sourcePath)) {
            return '';
        }

        $fileName = $path . '/' . uniqid() . '.' . pathinfo($sourcePath, PATHINFO_EXTENSION);

        Storage::disk('public')->put($fileName, file_get_contents($sourcePath));

        return $fileName;
    }

    public static function getSetting($key, $lang = null): ?string
    {
        $generalSettings = app(GeneralSettings::class);

        if ($lang == null) {
            $property = $key;
        } else {
            $property = $key . '_' . $lang;
        }

        return $generalSettings->$property ?? null;
    }

    public static function sendNotifyAdmin($title, $label, $route): void
    {
        $admin = User::where('type', 'admin')->first();
        FilamentNotification::make()
            ->title($title)
            ->actions([
                Action::make('view')
                    ->label($label)
                    ->button()

                    ->url(function () use ($route) {
                        return $route;
                    })
                    ->markAsRead()

            ])
            ->sendToDatabase($admin);

        event(new DatabaseNotificationsSent($admin));
    }

    public static function sendMail($email, $code, $name)
    {

        $data = [
            'code'  => $code,
            'name'  => $name
        ];

        Mail::to($email)->send(new VerificationCodeMail($code, $name));

        return true;
    }
}