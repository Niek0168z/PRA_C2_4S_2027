<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'filesize',
        'originUrl',
        'filename',
        'downloadedServer',
        'counter',
        'testcolumn',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'manual_type', 'manual_id', 'type_id');}
    // Returns the manual's short link code, generating and persisting one if it doesn't have one yet.
    // Since the code is stored once generated, every caller gets the same code back.
    public function getOrCreateShortCode(): string
    {
        if ($this->short_code) {
            return $this->short_code;
        }

        do {
            $code = $this->generateShortCode();
        } while (static::where('short_code', $code)->exists());

        $this->short_code = $code;
        $this->save();

        return $this->short_code;
    }

    private function generateShortCode(): string
    {
        // Avoids visually ambiguous characters (0/O, 1/l/I) so the code is easy to read and share.
        $chars = 'abcdefghjkmnpqrstuvwxyz23456789';

        $code = '';
        for ($i = 0; $i < 4; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $code;
    }



    // Returns the filesize in a human readable format
    public function getFilesizeHumanReadableAttribute(){

        $size = $this->filesize;
        $unit = "";

        if( (!$unit && $size >= 1<<30) || $unit == "GB")
            $value = number_format($size/(1<<30),2)."GB";
        elseif( (!$unit && $size >= 1<<20) || $unit == "MB")
            $value = number_format($size/(1<<20),2)."MB";
        elseif( (!$unit && $size >= 1<<10) || $unit == "KB")
            $value = number_format($size/(1<<10),2)."KB";
        else
            $value = number_format($size)." bytes";

        return $value;
    }

    // Returns true if the file is locally available
    public function getLocallyAvailableAttribute()
    {
        // As of 13-11-2017 we no longer link to local files, so we can cancel the TransIP server
        return false;

        /* $filename = $this->filename;

        return !empty($filename); */
    }

    public function getUrlAttribute()
    {
        return $this->originUrl;

        /* $filename = $this->filename;
        $originUrl = $this->originUrl;

        // If it's downloaded a filename is available, link to our own CDN
        if( !empty($filename ) )
            $url = 'http://cdn.downloadyourmanual.com/'.$filename;
        else	// If it's not download, link to the origin
            $url = $originUrl;

        return $url; */
    }
}
