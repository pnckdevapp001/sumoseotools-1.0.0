<?php
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Profile;
use App\Http\Livewire\Frontend\Tools\ImageCompressor;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\AuthPagesController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\JsonController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\Languages;
use App\Models\Admin\General;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Config::set('livewire.asset_url', url('/') );
//Config::set('livewire.asset_url', secure_url('/') );


try {

		$langData = Languages::where('status', true)->get(['code'])->toArray();

		if (!empty($langData)) {

			$locales = array();

			foreach ($langData as $value) {
			    array_push( $locales, $value['code'] );
			}

			Config::set('localization.supported-locales', $locales);

			Config::set('translatable.locales', $locales);

			if ( General::first()->automatic_language_detection == true ) {

				Config::set('localization.accept-language-header', true);
				Config::set('localization.hide-default-in-url', false);

			} else {

				$default = Languages::where('default', true)->first()->code;
				Config::set('app.locale', $default);
				Config::set('localization.hide-default-in-url', true);
			}
		}

} catch (\Exception $e) {
	
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

//Install
Route::group(['middleware' => 'swinstall', 'prefix' => 'install'], function () {

	Route::get('/', function () {
	    return view('frontend.install');
	})->name('sw_install');

	Route::get('/requirements', function () {
	    return view('frontend.install');
	})->name('sw_requirements');

	Route::get('/database', function () {
	    return view('frontend.install');
	})->name('sw_database');

	Route::get('/admin', function () {
	    return view('frontend.install');
	})->name('sw_admin');

	Route::get('/import', function () {
	    return view('frontend.install');
	})->name('sw_import');

	Route::get('/finished', function () {
	    return view('frontend.install');
	})->name('sw_finished');

});

//Cookie
Route::get('/cookies/accept', function(){
    Cookie::queue('cookies', time(), 43200);
});

//Image Compressor
Route::post('/image-compressor', [ImageCompressor::class, 'onImageCompressor'])->name('image-compressor');

//Theme Mode Toggle
Route::get('/theme/mode', function(){

    if ( Cookie::get('theme_mode') === 'theme-dark' ) {

    	Cookie::queue('theme_mode', 'theme-light', 43200);
    }
    else if ( Cookie::get('theme_mode') === 'theme-light' ) {

    	Cookie::queue('theme_mode', 'theme-dark', 43200);

    } else {

    	Cookie::queue('theme_mode', 'theme-dark', 43200);
    }

});

//Dir mode Toggle
Route::get('/dir/mode', function(){

    if ( Cookie::get('dir_mode') === 'rtl' ) {

    	Cookie::queue('dir_mode', 'ltr', 43200);
    }
    else if ( Cookie::get('dir_mode') === 'ltr' ) {

    	Cookie::queue('dir_mode', 'rtl', 43200);

    } else {

    	Cookie::queue('dir_mode', 'rtl', 43200);
    }

});

Route::localizedGroup(function () {

	//Verified
	Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	    $request->fulfill();
	    return redirect('/');
	})->middleware(['auth', 'signed'])->name('verification.verify');

	Route::group(['middleware' => 'auth'], function() {

		//User Profile
		Route::get('/profile', [AuthPagesController::class, 'index'])->name('user-profile');

		//Verify Email
		Route::get('/verify-email', [AuthPagesController::class, 'index'])->name('verify-email');

		//User logout
		Route::get('/logout', [Profile::class, 'onLogout'])->name('user-logout');

	});

	//Reset Password with Token
	Route::group(['middleware' => 'guest'], function() {

		//Login
		Route::get('/login', [AuthPagesController::class, 'index'])->name('login');

		//Register
		Route::get('/register', [AuthPagesController::class, 'index'])->name('register');

		//Forgot Password
		Route::get('/forgot-password', [AuthPagesController::class, 'index'])->name('forgot-password');

		//Reset Password
		Route::get('/reset-password/{token}', [AuthPagesController::class, 'index'])->name('password.reset');
	});

	//Home
	Route::get('/', [PagesController::class, 'home'])->name('home');

	//Blog
	try {
		
		if ( General::first()->blog_page_status == true ) {
			Route::get('/blog', [BlogController::class, 'index'])->name('blog');
		}

	} catch (\Exception $e) {
		
	}


	//Page
	Route::get('/{slug}', [PagesController::class, 'index'])->where('slug', '^((?!admin.*).)*$')->name('page');

	//Admin Login
	Route::group(['middleware' => ['guest', 'localized-auth']], function() {

		Route::get('/admin/login', [AuthPagesController::class, 'index'])->name('admin-login');

	});

	//Admin Dashboard
	Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isadmin', 'localized-auth']], function() {

			Config::set('app.version', '1.0.0' );

			Route::get('/' , function(){
			      return redirect()->back();
			})->name('admin');

			Route::get('/update' , function(){
			      return view('admin.update');
			})->name('update');

			Route::get('/dashboard', function () {
			    return view('admin.dashboard');
			})->name('dashboard');

			Route::group(['prefix' => 'pages'], function() {

				Route::get('/', function () {
				    return view('admin.pages');
				})->name('pages');

				Route::get('/posts', function () {
				    return view('admin.pages');
				})->name('posts');

				Route::get('/tools', function () {
				    return view('admin.pages');
				})->name('tools');

				Route::get('/categories', function () {
				    return view('admin.pages');
				})->name('categories');

				Route::get('/authentication', function () {
				    return view('admin.pages');
				})->name('authentication');

				Route::get('/{page_id}/translations', function () {
				    return view('admin.pages');
				})->name('page-translations');

				Route::get('/create/{page_id}/translations', function () {
				    return view('admin.pages');
				})->name('create-page-translations');

				Route::get('/edit/translations/{trans_id}', function () {
				    return view('admin.pages');
				})->name('edit-page-translations');

			});

			Route::get('/settings', function () {
			    return view('admin.settings');
			})->name('settings');

			Route::get('/users', function () {
			    return view('admin.users');
			})->name('users');

			Route::get('/history', function () {
			    return view('admin.history');
			})->name('history');

			Route::get('/report', function () {
			    return view('admin.report');
			})->name('report');

			Route::get('/cache', function () {
			    return view('admin.cache');
			})->name('cache');

			Route::get('/sitemap', function () {
			    return view('admin.sitemap');
			})->name('sitemap');

			Route::get('/about', function () {
			    return view('admin.about');
			})->name('about');
			
			Route::group(['prefix' => 'settings'], function () {

				Route::get('/general', function () {
				    return view('admin.general');
				})->name('general');

				Route::get('/menu', function () {
				    return view('admin.menu');
				})->name('menu');

				Route::get('/header', function () {
				    return view('admin.header');
				})->name('header');

				Route::get('/footer', function () {
				    return view('admin.footer');
				})->name('footer');

				Route::get('/footer/create/translations', function () {
				    return view('admin.footer');
				})->name('create-footer-translations');

				Route::get('/footer/edit/translations/{trans_id}', function () {
				    return view('admin.footer');
				})->name('edit-footer-translations');

				Route::get('/sidebar', function () {
				    return view('admin.sidebar');
				})->name('sidebar');

				Route::get('/gdpr', function () {
				    return view('admin.gdpr');
				})->name('gdpr');

				Route::get('/advertisement', function () {
				    return view('admin.advertisement');
				})->name('advertisement');

				Route::get('/smtp', function () {
				    return view('admin.smtp');
				})->name('smtp');

				Route::get('/api-keys', function () {
				    return view('admin.api-keys');
				})->name('api-keys');

				Route::get('/proxy', function () {
				    return view('admin.proxy');
				})->name('proxy');

				Route::get('/captcha', function () {
				    return view('admin.captcha');
				})->name('captcha');

				Route::get('/translations', function () {
				    return view('admin.translations');
				})->name('translations');

				Route::get('/translations/edit/{lang_id}', function () {
				    return view('admin.translations');
				})->name('edit-translations');

				Route::get('/redirects', function () {
				    return view('admin.redirects');
				})->name('redirects');

				Route::get('/advanced', function () {
				    return view('admin.advanced');
				})->name('advanced');

			});

			Route::group(['prefix' => 'user'], function () {

				Route::get('/profile', function () {
				    return view('admin.profile');
				})->name('profile');

				Route::get('/logout', [Profile::class, 'onLogout'])->name('logout');

			});

	});

});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'isadmin']], function () {
 	\UniSharp\LaravelFilemanager\Lfm::routes();
});