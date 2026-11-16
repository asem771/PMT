
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Developer Access | PMT</title>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0B1220;
            color: #E8EDF5;
            font-family: Tahoma, Arial, sans-serif;
        }

        .login-card {
            width: 90%;
            max-width: 420px;
            padding: 35px;
            background: #172438;
            border: 1px solid #2C3D54;
            border-top: 4px solid #C6A15B;
            border-radius: 15px;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            color: #C6A15B;
        }

        p {
            color: #A7B4C7;
        }

        input {
            width: 100%;
            padding: 13px;
            margin: 18px 0;
            box-sizing: border-box;
            border: 1px solid #2C3D54;
            border-radius: 8px;
            background: #111E30;
            color: white;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #C6A15B;
            color: #14243A;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
        }

        .error {
            color: #F87171;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <h2>PMT Developer Access</h2>

        <p>أدخل كلمة المرور للوصول إلى أدوات المطورين</p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('developer.authenticate') }}">
            @csrf

            <input
                type="password"
                name="password"
                placeholder="أدخل كلمة المرور"
                required
                autofocus
            >

            <button type="submit">
                تسجيل الدخول
            </button>
        </form>

    </div>

</body>
</html>
