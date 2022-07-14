<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Brotzka\DotenvEditor\DotenvEditor;

class Smtp extends Component
{
	public $host;
	public $port;
	public $username;
	public $password;
	public $encryption;
	public $appname;
	public $sender;
	
	public function mount()
	{
		$env              = new DotenvEditor();
		$this->appname    = $env->getValue("APP_NAME");
		$this->host       = $env->getValue("MAIL_HOST");
		$this->port       = $env->getValue("MAIL_PORT");
		$this->username   = $env->getValue("MAIL_USERNAME");
		$this->password   = $env->getValue("MAIL_PASSWORD");
		$this->encryption = $env->getValue("MAIL_ENCRYPTION");
		$this->sender     = $env->getValue("MAIL_FROM_ADDRESS");
	}

    public function render()
    {
        return view('livewire.admin.settings.smtp');
    }

    public function onUpdateSMTP(){

    	try {

	        $env = new DotenvEditor();

	        $env->changeEnv([
				'APP_NAME'          => $this->appname,
				'MAIL_HOST'         => $this->host,
				'MAIL_PORT'         => $this->port,
				'MAIL_USERNAME'     => $this->username,
				'MAIL_PASSWORD'     => $this->password,
				'MAIL_ENCRYPTION'   => $this->encryption,
				'MAIL_FROM_ADDRESS' => $this->username
	        ]);

	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!')]);
        
    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}

    }
}
