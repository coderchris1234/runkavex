<?php

use App\Http\Controllers\Admin\AdminAuditController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCmsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminExportController;
use App\Http\Controllers\Admin\AdminInvestmentController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\AdminLoanPlanController;
use App\Http\Controllers\Admin\AdminManualEntryController;
use App\Http\Controllers\Admin\AdminMarketController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AdminReferralController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSignalController;
use App\Http\Controllers\Admin\AdminSupportController;
use App\Http\Controllers\Admin\AdminTradeController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about', ['pageTitle' => 'Runkavex Capital | About']);
});

Route::get('/careers', function () {
    return view('careers', ['pageTitle' => 'Runkavex Capital | Careers']);
});

Route::get('/markets', function () {
    return view('markets', ['pageTitle' => 'Runkavex Capital | Markets']);
});

Route::get('/legal-docs', function () {
    return view('legal-docs', ['pageTitle' => 'Runkavex Capital | Legal Docs & FAQ']);
});

Route::get('/contact', function () {
    return view('contact', ['pageTitle' => 'Runkavex Capital | Contact Us']);
});

Route::get('/terms', function () {
    return view('terms', [
        'pageTitle' => 'Runkavex Capital | Risk Warning',
        'legal' => \App\Models\PageSection::where('key', 'terms_body')->value('content'),
    ]);
});

Route::get('/privacy', function () {
    return view('privacy', [
        'pageTitle' => 'Runkavex Capital | AML Policy',
        'legal' => \App\Models\PageSection::where('key', 'privacy_body')->value('content'),
    ]);
});

Route::get('/risk', function () {
    return view('risk', [
        'pageTitle' => 'Runkavex Capital | Risk Disclosure',
        'legal' => \App\Models\PageSection::where('key', 'risk_body')->value('content'),
    ]);
});

Route::get('/security', function () {
    return view('security', [
        'pageTitle' => 'Runkavex Capital | Security',
        'legal' => \App\Models\PageSection::where('key', 'security_body')->value('content'),
    ]);
});

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{article}', [NewsController::class, 'show'])->name('news.show');

Route::get('/forgot-password', function () {
    return view('forgot-password', ['pageTitle' => 'Forgot your password | Runkavex Capital', 'metaDesc' => 'Forgot your password']);
});
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/deposits', [DashboardController::class, 'showDeposits'])->name('deposits');
    Route::post('/deposits', [DashboardController::class, 'storeDeposit']);

    Route::get('/withdrawals', [DashboardController::class, 'showWithdrawals'])->name('withdrawals');
    Route::post('/withdrawals', [DashboardController::class, 'storeWithdrawal']);

    Route::get('/accounthistory', [DashboardController::class, 'accountHistory'])->name('history');
    Route::get('/portfolio', [DashboardController::class, 'portfolio'])->name('portfolio');
    Route::get('/buy-plan', [DashboardController::class, 'buyPlan'])->name('buy-plan');
    Route::post('/buy-plan', [DashboardController::class, 'storePlan']);
    Route::get('/myplans/{status?}', [DashboardController::class, 'myPlans'])->name('my-plans');

    Route::get('/account-settings', [DashboardController::class, 'accountSettings'])->name('account-settings');
    Route::post('/account-settings', [DashboardController::class, 'updateAccountSettings']);

    // Notifications JSON endpoints
    Route::get('/notifications/unread', [DashboardController::class, 'unreadNotifications']);
    Route::post('/notifications/read-all', [DashboardController::class, 'readAllNotifications']);

    // Static dashboard pages
    Route::get('/trade', [DashboardController::class, 'trade'])->name('trade');
    Route::post('/trades', [DashboardController::class, 'storeTrade']);
    Route::post('/trades/process', [DashboardController::class, 'processExpiredTrade']);
    Route::post('/trades/request-close', [DashboardController::class, 'requestCloseSpot']);
    Route::get('/connect-wallet', [DashboardController::class, 'showConnectWallet'])->name('connect-wallet');
    Route::get('/notification', [DashboardController::class, 'notifications'])->name('notification');
    Route::view('/support', 'dashboard.support')->name('support');
    Route::view('/support/create', 'dashboard.support-create')->name('support-create');
    Route::post('/support', [DashboardController::class, 'storeSupport']);
    Route::get('/trades/positions', [DashboardController::class, 'positions'])->name('positions');
    Route::get('/copy-trading/expert/{id}', [DashboardController::class, 'expertPage'])->name('expert');
    Route::post('/copy-trading/expert/{id}/copy', [DashboardController::class, 'startCopying'])->name('start-copying');
    Route::get('/markets', [DashboardController::class, 'markets'])->name('markets');
    Route::view('/copy-trading', 'dashboard.copy-trading')->name('copy-trading');
    Route::view('/bot-trading', 'dashboard.bot-trading')->name('bot-trading');
    Route::get('/bot-trading/bot/{id}', [DashboardController::class, 'botPage'])->name('bot-detail');
    Route::post('/bot-trading/bot/{id}/run', [DashboardController::class, 'startBot'])->name('start-bot');
    Route::get('/tradinghistory', [DashboardController::class, 'tradingHistory'])->name('tradinghistory');
    Route::get('/loans/apply', [DashboardController::class, 'loansApply']);
    Route::post('/loans/calculate-preview', [DashboardController::class, 'loanPreview']);
    Route::post('/loans/store', [DashboardController::class, 'storeLoan']);
    Route::get('/my-loans', [DashboardController::class, 'myLoans']);
    Route::view('/pre-ipo', 'dashboard.pre-ipo')->name('pre-ipo');
    Route::get('/pre-ipo/holdings', [DashboardController::class, 'preIpoHoldings'])->name('pre-ipo-holdings');
    Route::get('/pre-ipo/{id}', [DashboardController::class, 'preIpoPage'])->name('pre-ipo-company');
    Route::post('/pre-ipo/{id}/buy', [DashboardController::class, 'buyPreIpo'])->name('pre-ipo-buy');
    Route::view('/stocks', 'dashboard.stocks')->name('stocks');
    Route::get('/stocks/portfolio', [DashboardController::class, 'stockPortfolio'])->name('stocks-portfolio');
    Route::get('/stocks/history', [DashboardController::class, 'stockHistory'])->name('stocks-history');
    Route::get('/stocks/{id}', [DashboardController::class, 'stockPage'])->name('stock-detail');
    Route::post('/stocks/{id}/trade', [DashboardController::class, 'tradeStock'])->name('stock-trade');
    Route::view('/singalssubscriptions', 'dashboard.singalssubscriptions')->name('singalssubscriptions');
    Route::view('/subscribe-signals', 'dashboard.subscribe-signals')->name('subscribe-signals');
    Route::post('/subscribe', [DashboardController::class, 'storeSubscribe']);
    Route::get('/my-subscriptions', [DashboardController::class, 'mySubscriptions'])->name('my-subscriptions');
    Route::get('/nft-gallery', [DashboardController::class, 'nftGallery'])->name('nft-gallery');
    Route::get('/nfts/create', [DashboardController::class, 'nftMint'])->name('nfts-create');
    Route::post('/nfts/store', [DashboardController::class, 'nftStore'])->name('nfts-store');
    Route::get('/my-nfts', [DashboardController::class, 'myNfts'])->name('my-nfts');
    Route::get('/nfts/collection/{collection}', [DashboardController::class, 'nftCollection'])->name('nft-collection');
    Route::get('/nfts/{id}', [DashboardController::class, 'nftDetail'])->name('nft-detail');
    Route::post('/nfts/{id}/buy', [DashboardController::class, 'nftBuy'])->name('nft-buy');
    Route::view('/courses', 'dashboard.courses')->name('courses');
    Route::get('/course-details/{slug}/{courseId}', [DashboardController::class, 'courseDetails'])->name('course-details');
    Route::post('/courses/enroll/{courseId}', [DashboardController::class, 'enrollCourse'])->name('enroll-course');
    Route::get('/learning/{lesson}', [DashboardController::class, 'learning'])->name('learning');
    Route::get('/my-courses', [DashboardController::class, 'myCourses'])->name('my-courses');
    Route::view('/referuser', 'dashboard.referuser')->name('referuser');
    Route::view('/news', 'dashboard.news')->name('news');
});

// ==================== ADMIN PANEL ====================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
        Route::put('/users/{user}', [AdminUserController::class, 'update']);
        Route::post('/users/{user}/password', [AdminUserController::class, 'changePassword']);
        Route::post('/users/{user}/balance', [AdminUserController::class, 'adjustBalance']);
        Route::post('/users/{user}/toggle-active', [AdminUserController::class, 'toggleActive']);
        Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin']);
        Route::post('/users/create', [AdminUserController::class, 'store']);

        // Manual transaction entry
        Route::post('/manual/deposits', [AdminManualEntryController::class, 'storeDeposit']);
        Route::post('/manual/withdrawals', [AdminManualEntryController::class, 'storeWithdrawal']);

        // Transactions ledger + export
        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions');
        Route::get('/transactions/export', [AdminTransactionController::class, 'export']);

        // CSV exports
        Route::get('/exports/users', [AdminExportController::class, 'exportUsers'])->name('admin.exports.users');
        Route::get('/exports/transactions', [AdminExportController::class, 'exportTransactions'])->name('admin.exports.transactions');

        // Referrals & bonuses
        Route::get('/referrals', [AdminReferralController::class, 'index'])->name('admin.referrals');
        Route::get('/referrals/tree/{user}', [AdminReferralController::class, 'tree'])->name('admin.referrals.tree');
        Route::post('/referrals/{user}/bonus', [AdminReferralController::class, 'adjustBonus']);

        // Notifications
        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
        Route::post('/notifications', [AdminNotificationController::class, 'store']);
        Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'delete']);

        // Audit log
        Route::get('/audit', [AdminAuditController::class, 'index'])->name('admin.audit');

        // Reports
        Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports');

        // Content editor (CMS)
        Route::get('/content', [AdminCmsController::class, 'index'])->name('admin.cms');
        Route::post('/content', [AdminCmsController::class, 'update']);

        Route::get('/deposits', [AdminDepositController::class, 'index'])->name('admin.deposits');
Route::get('/deposits/{deposit}/proof', [AdminDepositController::class, 'proof'])->name('admin.deposits.proof');
        Route::post('/deposits/{deposit}/approve', [AdminDepositController::class, 'approve']);
        Route::post('/deposits/{deposit}/reject', [AdminDepositController::class, 'reject']);

        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('admin.withdrawals');
        Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve']);
        Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject']);

        Route::get('/trades', [AdminTradeController::class, 'index'])->name('admin.trades');
        Route::get('/trades/create', [AdminTradeController::class, 'create'])->name('admin.trades.create');
        Route::post('/trades/create', [AdminTradeController::class, 'store']);
        Route::get('/trades/{trade}', [AdminTradeController::class, 'show'])->name('admin.trades.show');
        Route::post('/trades/{trade}/settle', [AdminTradeController::class, 'settle']);

        Route::get('/loans', [AdminLoanController::class, 'index'])->name('admin.loans');
        Route::post('/loans/{loan}/approve', [AdminLoanController::class, 'approve']);
        Route::post('/loans/{loan}/reject', [AdminLoanController::class, 'reject']);
        Route::post('/loans/{loan}/repay', [AdminLoanController::class, 'markRepaid']);

        Route::get('/investments', [AdminInvestmentController::class, 'index'])->name('admin.investments');
        Route::post('/investments/{investment}/approve', [AdminInvestmentController::class, 'approve']);
        Route::post('/investments/{investment}/reject', [AdminInvestmentController::class, 'reject']);

        Route::get('/support', [AdminSupportController::class, 'index'])->name('admin.support');
        Route::get('/support/{ticket}', [AdminSupportController::class, 'show'])->name('admin.support.show');
        Route::post('/support/{ticket}/reply', [AdminSupportController::class, 'reply']);
        Route::post('/support/{ticket}/close', [AdminSupportController::class, 'close']);

        Route::get('/signals', [AdminSignalController::class, 'subscriptions'])->name('admin.signals');
        Route::post('/signals/{subscription}/approve', [AdminSignalController::class, 'approve']);
        Route::post('/signals/{subscription}/reject', [AdminSignalController::class, 'reject']);
        Route::get('/signals/plans', [AdminSignalController::class, 'plans'])->name('admin.signal-plans');
        Route::post('/signals/plans', [AdminSignalController::class, 'storePlan']);
        Route::put('/signals/plans/{plan}', [AdminSignalController::class, 'updatePlan']);
        Route::delete('/signals/plans/{plan}', [AdminSignalController::class, 'destroyPlan']);

        Route::get('/plans', [AdminPlanController::class, 'index'])->name('admin.plans');
        Route::post('/plans', [AdminPlanController::class, 'store']);
        Route::put('/plans/{plan}', [AdminPlanController::class, 'update']);
        Route::delete('/plans/{plan}', [AdminPlanController::class, 'destroy']);

        Route::get('/markets', [AdminMarketController::class, 'index'])->name('admin.markets');
        Route::post('/markets', [AdminMarketController::class, 'store']);
        Route::put('/markets/{market}', [AdminMarketController::class, 'update']);
        Route::post('/markets/{market}/toggle', [AdminMarketController::class, 'toggle'])->name('admin.markets.toggle');
        Route::delete('/markets/{market}', [AdminMarketController::class, 'destroy'])->name('admin.markets.destroy');

        Route::get('/loan-plans', [AdminLoanPlanController::class, 'index'])->name('admin.loan-plans');
        Route::post('/loan-plans', [AdminLoanPlanController::class, 'store']);
        Route::put('/loan-plans/{plan}', [AdminLoanPlanController::class, 'update']);
        Route::delete('/loan-plans/{plan}', [AdminLoanPlanController::class, 'destroy'])->name('admin.loan-plans.destroy');

        Route::get('/articles', [AdminArticleController::class, 'index'])->name('admin.articles');
        Route::post('/articles', [AdminArticleController::class, 'store']);
        Route::put('/articles/{articleId}', [AdminArticleController::class, 'update']);
        Route::post('/articles/{articleId}/toggle', [AdminArticleController::class, 'toggle'])->name('admin.articles.toggle');
        Route::delete('/articles/{articleId}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');

        Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [AdminSettingController::class, 'update']);
    });
});