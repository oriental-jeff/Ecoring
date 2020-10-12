<?php
use Facades\App\Repository\Menus;

if (! function_exists('get_custom_class')) {
	function get_custom_class($prefix, $class)
	{
		$objClass = $prefix . ucfirst($class);

    return get_class(new $objClass());
	}
}

if (! function_exists('get_main')) {
  function get_main()
  {
    $menus = Menus::all('sort');
    $main = [
      'menus' => $menus,
      'web_info' => App\Model\WebInfo::find(1),
      'web_socials' => App\Model\WebSocial::onlyActive()->get(),
      'categories' => App\Model\Categories::get(),
      'count_cart_products' => App\Model\Cart::where('users_id', Auth::id())->whereNull('orders_id')->count(),
      'order_not_pay' => App\Model\Orders::where('users_id', Auth::id())->onlyNotPay()->orderBy('id', 'asc')->get(),
      'bank_transfer' => App\Model\BankAccounts::onlyActive()->get(),
      'logistics' => App\Model\Logistics::onlyActive()->get(),
    ];

    return $main;
  }
}

if (! function_exists('get_lang')) {
  function get_lang($field='') {
    $lang = app()->getLocale();
    if(!empty($field)) {
      return $field.'_'.$lang;
    }
    return $lang;
  }
}

if (! function_exists('get_link_share_facebook')) {
  function get_link_share_facebook() {
    return 'https://www.facebook.com/sharer/sharer.php?u='.url()->current();
  }
}

if (! function_exists('get_link_share_twitter')) {
  function get_link_share_twitter( $title ='') {
    return 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.url()->current();
  }
}

if (! function_exists('add_log')) {
  function add_log($model, $model_id, $action='view', $description='') {
    $log = App\Model\ViewActivityLog::create([
      'model'       => $model,
      'model_id'    => $model_id,
      'action'      => $action,
      'action_by'    => 0,
      'description' => $description,
    ]);

    return ('addlog complate');
  }
}

if (! function_exists('get_log_action')) {
  function get_log_action($model, $model_id, $action='view') {
    $count = App\Model\ViewActivityLog::where('model', $model)
      ->where('model_id', $model_id)
      ->where('action', $action)
      ->count();

    return $count;
  }
}

if (! function_exists('get_logs_action')) {
  function get_logs_action($model, $action='view') {
    $count = App\Model\ViewActivityLog::selectRaw('* , COUNT(id) as sum')
      ->where('model', $model)
      ->where('action', $action)
      ->groupBy('model_id')
      ->get();
    $count = $count->mapWithKeys(function($item) {
      return [$item['model_id'] => $item['sum']];
    });

    return $count;
  }
}

if (! function_exists('time_elapsed_string')) {
  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
}
