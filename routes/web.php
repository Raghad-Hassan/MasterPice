<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\Admin\AnnualConferenceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\ConferenceRegistrationController;
use App\Http\Controllers\Idea\IdeaController;
use App\Http\Controllers\NotificationController;

/*
|---------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحات الرئيسية والثابتة
Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/', [HomeController::class, 'index'])->name('index');



// الصفحات الثابتة
Route::prefix('user')->group(function () {
    Route::get('/opportunit-details', function () {
        return view('user.opportunit-details');
    })->name('opportunit-details');

    Route::get('/انضم', function () {
        return view('conferences.register');
    })->name('انضم');

    Route::get('/بنك', function () {
        return view('ideas.create');
    })->name('بنك');

    Route::get('/تعرف', function () {
        return view('user.تعرف علينا');
    })->name('تعرف');

    Route::get('/عرض', function () {
        return view('user.عرض الفرص');
    })->name('عرض');

    Route::get('/نساهم', function () {
        return view('user.لماذا نساهم');
    })->name('نساهم');
});

// -------------------------------------------------


// Authentication Routes for Guest Users


Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');

  Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
});
Route::post('/personal', [UserAuthController::class, 'login'])->name('login.submit');  


Route::get('/personal1',[UserAuthController::class, 'showLoginForm'])->name('login1');


Route::post('/logout', [UserAuthController::class, 'logout']) ->middleware('auth')->name('logout');

// Protected Routes

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/Annual', [AnnualConferenceController::class, 'index'])->name('admin.Annual');
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    });

    Route::middleware(['volunteer'])->group(function () {
     Route::get('/volunteer/dashboard', fn() => view('index'))->name('volunteer.dashboard');
    });
});

// Email Verification Routes (Protected by auth middleware)
Route::middleware(['auth'])->group(function () {
     Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('index')->with('success', 'تم تحقق بريدك الإلكتروني بنجاح!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'تم إرسال رابط التحقق إلى بريدك الإلكتروني!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Protected Routes (تتطلب تسجيل دخول وتفعيل البريد)


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ---------------------------- 

// -----------------------------Conference
Route::prefix('conferences')->group(function () {
   
    Route::get('/', [ConferenceController::class, 'index'])->name('conferences.index');
    
   
    Route::get('/{id}', [ConferenceController::class, 'show'])->name('conferences.show');
    
 
    Route::get('/{conference}/register', [ConferenceController::class, 'showRegistrationForm'])
         ->name('conferences.register.form');
    
 
    Route::post('/{conference}/register', [ConferenceController::class, 'register'])
         ->name('conferences.register.submit');
});


Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->name('admin.')
    ->group(function () {
        
       
        Route::resource('annual-conferences', AnnualConferenceController::class)
            ->names([
                'index' => 'annual-conferences.index',
                'create' => 'annual-conferences.create',
                'store' => 'annual-conferences.store',
                'show' => 'annual-conferences.show',
                'edit' => 'annual-conferences.edit',
                'update' => 'annual-conferences.update',
                'destroy' => 'annual-conferences.destroy'
            ])
            ->except(['show']); 
        
       
        Route::get('/conferences/reports', [AnnualConferenceController::class, 'reports'])
             ->name('conferences.reports');
    });

    Route::get('/admin/annual-conferences/{id}/participants', [ConferenceController::class, 'showParticipants'])->name('admin.annual-conferences.participants');

    //   لعرض المشاركين في المؤتمر السنوي
    Route::get('/admin/statistics', [DashboardController::class, 'showStatistics'])->name('admin.statistics');


// -------------------------------------idea

Route::middleware(['auth'])->group(function () {
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
});


Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');





// -------------------------------------Notification
// Route::get('/notifications/markAsRead/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    
    Route::get('ideas', [IdeaController::class, 'showIdeasForAdmin'])->name('ideas.index');
    
   
    Route::get('idea/approve/{id}', [IdeaController::class, 'approveIdea'])->name('idea.approve');
    
  
    Route::get('idea/reject/{id}', [IdeaController::class, 'rejectIdea'])->name('idea.reject');
    
    
    Route::get('idea/delete/{id}', [IdeaController::class, 'deleteIdea'])->name('idea.delete');
});
