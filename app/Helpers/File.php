<?php


if (! function_exists('getImageFileWithBlank')) {
	function getImageFileWithBlank($file)
	{
		if (empty($file)) {
			return asset('images/no-image.jpg');
		}

	    if (filter_var($file, FILTER_VALIDATE_URL)) { 
	        return $file;
	    }
	    
	    return asset('storage/' . $file);
	}
}

if (! function_exists('getImageFileWithDefault')) {
	function getImageFileWithDefault($defaultFile, $file)
	{
		if (! empty($file)) {
			return asset('storage/' . $file);
		}

	    if (filter_var($defaultFile, FILTER_VALIDATE_URL)) { 
	        return $defaultFile;
	    }
	    
	    return asset('storage/' . $defaultFile);
	}
}

if (! function_exists('deleteImageTmp')) {
  function deleteImageTmp()
  {
    $storage_files = array_diff(scandir(storage_path('tmp/uploads/')), array('..', '.'));
    if(!empty($storage_files)):
      foreach ($storage_files as $file) :
        unlink(storage_path('tmp/uploads/'.$file));
      endforeach;
    endif;
  }
}


if (! function_exists('mapPermission')) {
  function mapPermission($module)
  {
    $method = request()->route()->getActionMethod();
    $map_key = [ 
      'index'   => 'access',
      'show'    => 'access',
      'search'  => 'access',
      'create'  => 'add',
      'store'   => 'add',
      'edit'    => 'edit',
      'update'  => 'edit',
      'destroy' => 'delete',
    ];

    return $map_key[$method].' '.$module;
  }
}