<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد البريد الإلكتروني</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8f9fa; direction: rtl; }
        .verification-box { max-width: 600px; margin: 100px auto; padding: 30px; background: white; 
                           border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); text-align: center; }
        .verification-icon { font-size: 50px; color: #02d3ac; margin-bottom: 20px; }
        p { direction: rtl; text-align: right; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="verification-box">
        <div class="verification-icon"><i class="fas fa-envelope"></i></div>
        <h2>تأكيد البريد الإلكتروني</h2>
        <p class="mt-3">قبل المتابعة، يرجى التحقق من بريدك الإلكتروني عبر رابط التحقق الذي أرسلناه إليك.</p>
        <p>إذا لم تستلم البريد الإلكتروني،</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">انقر هنا لإرسال رابط آخر</button>
        </form>
    </div>
</body>
</html>