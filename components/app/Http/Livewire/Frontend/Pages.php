<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Page;
use App\Models\Admin\PageCategory;
use App\Models\Admin\General;

class Pages extends Component
{
	public $email;
	public $password;
	public $password_confirmation;
	public $token;
	public $fullname;
	public $remember_me;

	public $page;
	public $pageTrans;
	public $homeTitle;
	public $general;
	public $profile;
	public $menus;
	public $header;
	public $footer;
	public $captcha;
	public $notice;
	public $supported_sites;
	public $advanced;
	public $advertisement;
	public $socials;
	public $twitter;
	public $recent_posts;
	public $popular_tools;
	public $sidebar;
	public $searchQuery = '';

	public $data = [];
	public $link;

    public function mount()
    {

		$page            = $this->page;
		$pageTrans       = $this->pageTrans;
		$homeTitle       = $this->homeTitle;
		$general         = $this->general;
		$profile         = $this->profile;
		$menus           = $this->menus;
		$header          = $this->header;
		$footer          = $this->footer;
		$captcha         = $this->captcha;
		$notice          = $this->notice;
		$supported_sites = $this->supported_sites;
		$advanced        = $this->advanced;
		$advertisement   = $this->advertisement;
		$socials         = $this->socials;
		$twitter         = $this->twitter;
		$recent_posts    = $this->recent_posts;
		$popular_tools   = $this->popular_tools;
		$sidebar         = $this->sidebar;
		$this->token     = request()->route('token');
		$this->email     = old('email', request()->email);
		$this->fullname  = Auth::user()->fullname ?? null;
    }

    public function render()
    {
        return view('livewire.frontend.pages', [
			'tool_with_categories' => PageCategory::with('pages')->orderBy('sort', 'ASC')->get()->toArray(),
			'related_tools' 	   => Page::where('category_id', $this->page->category_id)->where('id', '!=', $this->page->id)->where('tool_status', true)->inRandomOrder()->take( General::orderBy('id', 'DESC')->first()->related_tools_count )->get()->toArray(),
			'tools'                => Page::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'tool')->where('tool_status', true)->orderBy('position', 'ASC')->orderByTranslation('id', 'ASC')->get()->toArray(),
			'search_queries'       => Page::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'tool')->where('title', 'LIKE', '%'.$this->searchQuery.'%')->where('tool_status', true)->orderByTranslation('id', 'DESC')->get()->toArray()
        ]);
    }

}
