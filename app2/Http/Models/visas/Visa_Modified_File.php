<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Client;
class Visa_Modified_File extends Model
{
	protected $table = "visa_modified_files";
	protected $fillable = ['visa_id' , 'file'];

	public function createFiles($files , $id)
	{
		$upload = new \App\Client;
		foreach($files as $file)
		{
			if($file != null)
			{
				$uplodedFile = $upload->uploadFile($file);
				$this->create([
					'visa_id'=>$id,
					'file'=>$uplodedFile,
					]);
			}
		}
	}

	public function editFiles($files , $editFiles , $id)
	{
		$dbFilesArr   = [];
		$editFilesArr = [];
		foreach($this->where('visa_id' , $id)->get() as $dbFile)
			array_push( $dbFilesArr , $dbFile->id);

		$upload = new \App\Client;
		//update previous files
		if($editFiles != null)
		{
			foreach($editFiles as $editFile => $value)
			{	
				array_push($editFilesArr , $editFile);
				if($value != null)
				{
					$file = $this->find($editFile);
					\File::delete(public_path().$file->file);
					$uplodedFile = $upload->uploadFile($value);
					$file->update(['file'=>$uplodedFile]);
				}
			}
		}	
		//delete removed files
		$arr_diff = array_diff($dbFilesArr, $editFilesArr);
		foreach ($arr_diff as $key => $value) 
		{
			$file = $this->find($value);
			\File::delete(public_path().$file->file);
			$file->delete();
		}
		//create new files
		if($files != null)
		{
			foreach($files as $file)
			{
				if($file != null)
				{
					$uplodedFile = $upload->uploadFile($file);
					$this->create([
						'visa_id'=>$id,
						'file'   =>$uplodedFile,
						]);
				}
			}
		}
	}
}
