<?php 
namespace App\Http\Controllers;
use File;
class HomeController extends Controller
{
    //$file = new file uploded 
    /*$filename = if it equal a value the file will be uploaded in it's name else
    it will take a random name */
    public function uploadFile($file , $fileName = null)
    {
    	if($file == null)
    		return "/noimage.gif";

    	$destinationPath = public_path().'/images/';

    	if($fileName == null)
    		$fileName = str_random(15).'.'.$file->getClientOriginalExtension();
    	else
    		$fileName = $file->getClientOriginalName();

    	$file->move($destinationPath , $fileName);
    	return '/images/'.$fileName;
    }
    
    //$file = new file uploded 
    //$original_file = the file value in databese
    /*$filename = if it equal a value the file will be uploaded in it's name else
    it will take a random name */
    public function updateFile($file , $original_file , $filename = null)
    {
    	if($file == null)
    		return $original_file;

    	if($file != "/noimage.gif")
    		File::delete(public_path().$file);
    	
		//call uploadFile function to make new file
    	return $this->uploadFile($file , $filename);
    }

}