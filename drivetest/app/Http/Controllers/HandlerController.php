<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

class HandlerController extends Controller
{
    protected $client;
    protected $folder_id;
    protected $service;
    protected $data_secret = array();
    protected $ClientId     = '653430692815-3l1lkf1hkf4504s7nkal47a8np7jihkm.apps.googleusercontent.com';
    protected $ClientSecret = 'f6olijdBVUjX4qqhkK6EHD-Z';
    protected $refreshToken = '1/bgHPLDCw_a9BqPr6ONM8yWWqVbuAiaxk10icQ8tu-bM';
    protected $filesystem;
    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setClientId($this->ClientId);
        $this->client->setClientSecret($this->ClientSecret);
        $this->client->refreshToken($this->refreshToken);
        $this->service = new \Google_Service_Drive($this->client);
        // we cache the id to avoid having google creating
        // a new folder on each time we call it,
        // because google drive works with 'id' not 'name'
        // & thats why u could have duplicated folders under the same name
        // Cache::rememberForever('folder_id', function () {
        //     return $this->create_folder();
        // });
        $this->folder_id = '0B3LDeutvTrsKY3NHdlpJaGRHejg';

        $adapter    = new GoogleDriveAdapter($this->service, $this->folder_id);
        $this->filesystem = new Filesystem($adapter);
    }

    protected function create_folder()
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name'     => 'google_drive_folder_name',
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);
        $folder = $this->service->files->create($fileMetadata, ['fields' => 'id']);
        return $folder->id;
    }

    public function upload_file(Request $request)
    {
        //cek apakah file ada
        if($request->hasFile('fileupload'))
        {
            $files = $request->file('fileupload');
            $fileName = $files->getClientOriginalName();
            $content = file_get_contents($files);
            
            // here we are uploading files from local storage
            // we first get all the files
            // loop over the found files
            Storage::disk('google')->put($fileName, $content);
            
            echo "Sukses";
        }


    }

    protected function remove_duplicated($file)
    {
        $response = $this->service->files->listFiles([
            'q' => "'$this->folder_id' in parents and name contains '$file' and trashed=false",
        ]);
        foreach ($response->files as $found) {
            return $this->service->files->delete($found->id);
        }
    }
}
