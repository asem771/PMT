
<?php

use App\Http\Controllers\TaskPageController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ========================================
// الصفحة الرئيسية
// ========================================

Route::get('/', fn () => redirect('/tasks'));


// ========================================
// تبديل اللغة
// ========================================

Route::get('/language/{locale}', function (string $locale) {

    if (!in_array($locale, ['ar', 'en'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();

})->name('language.switch');


// ========================================
// Developer Access
// حماية أدوات المطورين
// ========================================


// عرض صفحة كلمة المرور عند كل ضغطة
Route::get('/developer-access', function (Request $request) {

    // إنهاء حالة تسجيل الدخول السابقة
    session()->forget('developer_authenticated');

    // تحديد الرابط المطلوب
    $redirect = $request->query('redirect', '/docs/api');

    // السماح بروابط أدوات المطورين فقط
    if (
        !str_starts_with($redirect, '/api/') &&
        !in_array($redirect, ['/docs/api', '/docs/api.json'], true)
    ) {
        $redirect = '/docs/api';
    }

    // حفظ الرابط للانتقال إليه بعد نجاح الدخول
    session(['developer_redirect' => $redirect]);

    return view('developer.login');

})->name('developer.login');


// التحقق من كلمة المرور
Route::post('/developer-access', function (Request $request) {

    $request->validate([
        'password' => 'required|string',
    ]);

    $correctPassword = config('developer.password');

    if (!hash_equals(
        (string) $correctPassword,
        (string) $request->password
    )) {

        return back()->withErrors([
            'password' => 'كلمة المرور غير صحيحة.',
        ]);
    }

    // السماح بالوصول إلى أدوات المطورين
    session(['developer_authenticated' => true]);

    // الانتقال إلى الرابط المطلوب
    $redirect = session()->pull(
        'developer_redirect',
        '/docs/api'
    );

    return redirect($redirect);

})->name('developer.authenticate');


// تسجيل الخروج من أدوات المطورين
Route::post('/developer-logout', function () {

    session()->forget([
        'developer_authenticated',
        'developer_redirect',
    ]);

    return redirect('/tasks');

})->name('developer.logout');


// ========================================
// Tasks - إدارة المهام
// ========================================

Route::get('/tasks', [TaskPageController::class, 'index']);

Route::get('/tasks/create', [TaskPageController::class, 'create']);

Route::post('/tasks', [TaskPageController::class, 'store']);

Route::get('/tasks/{task}', [TaskPageController::class, 'show']);

Route::get('/tasks/{task}/edit', [TaskPageController::class, 'edit']);

Route::put('/tasks/{task}', [TaskPageController::class, 'update']);

Route::delete('/tasks/{task}', [TaskPageController::class, 'destroy']);

Route::post('/tasks/{task}/assign', [TaskPageController::class, 'assign']);

Route::delete('/tasks/{task}/students/{student}', [TaskPageController::class, 'unassign']);

Route::patch('/tasks/{task}/status', [TaskPageController::class, 'updateStatus']);


// ========================================
// Posts CRUD - إدارة المقالات
// ========================================

Route::resource('posts', PostController::class);
