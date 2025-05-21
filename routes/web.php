 <?php

use App\Models\VolunteerOpportunity;
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
use App\Http\Controllers\Idea\IdeaController as UserIdeaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\User\FeedbackController;
use App\Http\Controllers\User\NewsletterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\Organization\OpportunityController;
use App\Http\Controllers\Admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\Organization\UserOpportunityController;
use App\Http\Controllers\Organization\VolunteerOpportunityController;
use App\Http\Controllers\Idea\IdeaController;
use App\Http\Controllers\Organization\OpportunityCommentController;
use App\Http\Controllers\Organization\OpportunityReservationController;
use App\Http\Controllers\Organization\ApprovedIdeasController;
use App\Http\Controllers\Organization\CertificateController;
use App\Http\Controllers\Organization\GoalController;
use App\Http\Controllers\Organization\SdgImageController;
use App\Http\Controllers\Organization\OrganizationProfileController;
use App\Http\Controllers\Organization\InstitutionController;
use App\Http\Controllers\Organization\NewsletterSubscriptionController;
use App\Http\Controllers\Organization\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('index');

// Static Pages
// Route::get('/', function () {
//     return view('index');
// })->name('index');


Route::prefix('user')->group(function () {
    // Route::get('/opportunit-details', function () {
    //     return view('user.opportunit-details');
    // })->name('opportunit-details');

    Route::get('/انضم', function () {
        return view('conferences.register');
    })->name('انضم');

    Route::get('/بنك', [UserIdeaController::class , 'index'] )->name('بنك');

    Route::get('/تعرف', function () {
        return view('user.تعرف علينا');
    })->name('تعرف');

    Route::get('/user/عرض', function () {
        $opportunities = VolunteerOpportunity::all(); // جلب جميع الفرص
        return view('user.عرض الفرص', compact('opportunities'));
    })->name('عرض');

    Route::get('/نساهم', function () {
        return view('user.لماذا نساهم');
    })->name('نساهم');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
    Route::post('/personal', [UserAuthController::class, 'login'])->name('login.submit');  
    Route::get('/personal1', [UserAuthController::class, 'showLoginForm'])->name('login1');
});

Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth')->name('logout');

// Email Verification Routes
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

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload.photo');


// Conference Routes
Route::prefix('conferences')->group(function () {
    Route::get('/', [ConferenceController::class, 'index'])->name('conferences.index');
    Route::get('/{id}', [ConferenceController::class, 'show'])->name('conferences.show');
    Route::get('/{conference}/register', [ConferenceController::class, 'showRegistrationForm'])
         ->name('conferences.register.form');
    Route::post('/{conference}/register', [ConferenceController::class, 'register'])
         ->name('conferences.register.submit')
          ->middleware('auth');
});

// Idea Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
});
Route::middleware(['volunteer'])->group(function () {
    Route::get('/volunteer/dashboard', fn() => view('index'))->name('volunteer.dashboard');
   });


   Route::post('/idea/{idea}/like', [IdeaController::class, 'like'])->name('idea.like');


// ----------------------------


// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/statistics', [DashboardController::class, 'showStatistics'])->name('statistics');

        // Annual Conferences
        Route::resource('annual-conferences', AnnualConferenceController::class)->except(['show']);
        Route::get('/conferences/reports', [AnnualConferenceController::class, 'reports'])
             ->name('conferences.reports');
        Route::get('/annual-conferences/{id}/participants', [ConferenceController::class, 'showParticipants'])
             ->name('annual-conferences.participants');

        // Ideas Management
        Route::get('/ideas', [AdminIdeaController::class, 'showIdeasForAdmin'])->name('ideas.index');
        Route::get('/ideas/approved', [AdminIdeaController::class, 'showApprovedIdeas'])->name('ideas.approved');
        Route::post('/ideas/{idea}/approve', [AdminIdeaController::class, 'approve'])->name('ideas.approve');
        Route::post('/ideas/{idea}/reject', [AdminIdeaController::class, 'reject'])->name('ideas.reject');
        Route::delete('/ideas/{idea}', [AdminIdeaController::class, 'delete'])->name('ideas.delete');
        Route::get('/ideas/{idea}/edit', [AdminIdeaController::class, 'edit'])->name('ideas.edit');
        Route::put('/ideas/{idea}', [AdminIdeaController::class, 'update'])->name('ideas.update');
    });

    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');

   

    // Feedback
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/feedbacks', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedbacks.index');
    });

    // Notification 
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/newsletter', [App\Http\Controllers\Admin\NewsletterController::class, 'index'])->name('admin.newsletter.index');
    });
    
    // user CRUD

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
    
    // user CRUD sidebar

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
});

// profile
Route::get('/admin/profile', [App\Http\Controllers\Admin\AdminProfileController::class, 'show'])->name('admin.profile.show');
Route::post('/admin/profile/update', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('admin.profile.update');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('organizations', [AdminOrganizationController::class, 'index'])->name('admin.organizations.index');
    Route::get('organizations/create', [AdminOrganizationController::class, 'create'])->name('admin.organizations.create');
    Route::post('organizations', [AdminOrganizationController::class, 'store'])->name('admin.organizations.store');
    Route::get('organizations/{organization}/edit', [AdminOrganizationController::class, 'edit'])->name('admin.organizations.edit');
    Route::put('organizations/{organization}', [AdminOrganizationController::class, 'update'])->name('admin.organizations.update');
    Route::delete('organizations/{organization}', [AdminOrganizationController::class, 'destroy'])->name('admin.organizations.destroy');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('organizations', [\App\Http\Controllers\Admin\OrganizationController::class, 'index'])->name('admin.organizations.index');
});


    
// ---------------------------

    // Feedback user
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    


    // NewsletterController
    Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');





    // Organization

    // مسارات المؤسسات
 Route::prefix('organization')->group(function () {
    // تسجيل الدخول
    Route::get('/login', [OrganizationController::class, 'showLoginForm'])->name('organization.login');
    Route::post('/login', [OrganizationController::class, 'login'])->name('organization.login.submit');
    
    // إنشاء حساب
    Route::get('/register', [OrganizationController::class, 'showRegistrationForm'])->name('organization.register');
    Route::post('/register', [OrganizationController::class, 'register'])->name('organization.register.submit');
    
    // تسجيل الخروج
    Route::post('/logout', [OrganizationController::class, 'logout'])->name('organization.logout');
    
    // لوحة التحكم (محمية بـ middleware)
    
});


Route::prefix('organization')->name('organization.')->group(function () {
    Route::resource('opportunities', OpportunityController::class);
    Route::get('/comments', [OpportunityCommentController::class, 'index'])->name('comments.index');


});

Route::get('/opportunities/create', [OpportunityController::class, 'create'])
     ->name('organization.opportunities.create');


Route::post('/opportunities', [OpportunityController::class, 'store'])
     ->name('organization.opportunities.store');


Route::put('/volunteer_opportunities/{id}', [VolunteerOpportunityController::class, 'update'])->name('volunteer_opportunities.update');


Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('volunteer-opportunities', OpportunityController::class);
});


Route::get('/opportunities', [UserOpportunityController::class, 'index'])->name('opportunities.list');
Route::get('/opportunity/{id}', [UserOpportunityController::class, 'show'])->name('opportunity.details');


Route::get('/volunteer/opportunities/filter', [FilterController::class, 'filterOpportunities'])
     ->name('volunteer.opportunities.filter');


 Route::post('/opportunity/register', [UserOpportunityController::class, 'register'])->name('opportunity.register');

 // استخدم هذا إذا كنت تريد استخدام DashboardController
Route::prefix('organization')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\Organization\DashboardController::class, 'index'])
         ->name('organization.dashboard');
         
    Route::get('/dashboard/{id}', [\App\Http\Controllers\Organization\DashboardController::class, 'show'])
         ->name('organization.dashboard.show');
});



 // Comments routes
Route::prefix('organization')->group(function () {
    Route::post('/opportunity-comments', [OpportunityCommentController::class, 'store'])
        ->name('opportunity-comments.store');

    Route::get('/opportunity-comments/{opportunityId}', [OpportunityCommentController::class, 'index'])
        ->name('opportunity-comments.index');
});






use App\Http\Controllers\Organization\DashboardController as OrganizationDashboardController ;

Route::get('organization/opportunity/{id}', [OrganizationDashboardController::class, 'show'])->name('organization.opportunity.show');
Route::post('organization/application/accept/{applicationId}', [OrganizationDashboardController::class, 'acceptApplication'])->name('organization.application.accept');
Route::post('organization/application/reject/{applicationId}', [OrganizationDashboardController::class, 'rejectApplication'])->name('organization.application.reject');



// comment



// user dashbord




Route::post('/organization/logout', [OrganizationController::class, 'logout'])->name('organization.logout');

Route::post('/register-opportunity', [UserOpportunityController::class, 'registerOpportunity'])->name('user.registerOpportunity');


// ApprovedIdeas
Route::get('/institution/approved-ideas', [ApprovedIdeasController::class, 'index'])->name('institution.approvedIdeas');
Route::get('/organization/approved-ideas/{id}', [ApprovedIdeasController::class, 'show'])->name('organization.approved-ideas.show');

// dashbord user
Route::get('/dashboard/opportunities/{id}', [VolunteerOpportunityController::class, 'show'])
     ->name('organization.opportunities.show');

Route::get('opportunities/{opportunity}/applicants', [VolunteerOpportunityController::class, 'showApplicants'])->name('organization.opportunities.showApplicants');

Route::delete('opportunities/{opportunity}/remove-applicant/{application}', [OpportunityController::class, 'removeApplicant'])->name('organization.opportunities.removeApplicant');

Route::get('/organization/certificates/create', [CertificateController::class, 'create'])->name('organization.certificates.create');

Route::post('/organization/certificates', [CertificateController::class, 'store'])->name('organization.certificates.store');

//  sidebar
 Route::get('/dashboard/opportunities', [VolunteerOpportunityController::class, 'index'])
 ->name('organization.opportunities.index');


// newsletter
Route::get('/organization/newsletter', [NewsletterSubscriptionController::class, 'index'])->name('organization.newsletter.index');

// Comment
Route::get('organization/comments', [CommentController::class, 'index'])
    ->name('organization.comments.index');
