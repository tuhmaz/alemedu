<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocaleMiddleware;
use App\Http\Middleware\UpdateUserLastActivity;
use App\Http\Middleware\SwitchDatabase;
use App\Http\Middleware\SetDatabaseMiddleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )

  ->withMiddleware(function (Middleware $middleware) {
    // Middleware للواجهة الأمامية (web)
    $middleware->web(LocaleMiddleware::class);              // لتبديل اللغة
    $middleware->web(UpdateUserLastActivity::class);        // لتحديث نشاط المستخدم
    $middleware->web(SwitchDatabase::class);                // لتبديل قاعدة البيانات بناءً على المسار الفرعي

    // يمكنك إضافة المزيد من الـ Middleware إذا لزم الأمر.
  })
  ->withExceptions(function (Exceptions $exceptions) {
    // يمكنك التعامل مع الاستثناءات هنا.
  })->create();
