<?
	$json = file_get_contents('php://input');
	$files = json_decode($json);

	$zip = new ZipArchive();
	$return_name = '/upload/tmp/'.time().'.zip';
	$zip_name = $_SERVER['DOCUMENT_ROOT'].$return_name;

	if($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE)
	{
		echo "Sorry ZIP creation failed at this time";
	}

	foreach($files as $file)
	{
		$localname = explode('/', $file);
		$localname = array_reverse($localname);
		$zip->addFile($_SERVER['DOCUMENT_ROOT'].$file, $localname[0]);
	}

	$zip->close();

	echo($return_name);

?>