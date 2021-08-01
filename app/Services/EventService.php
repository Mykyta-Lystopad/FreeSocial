<?php


namespace App\Services;


use App\Models\Event;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class EventService
{

    /**
     * @return mixed
     */
   public function searchEvents()
   {

       if (request()->search){
           return $event = Event::where('title', 'like', '%'. request()->search. '%')
               ->orWhere('description', 'like', '%' . request()->search . '%')
//               ->orWhere('coordinates', 'like', '%'. request()->search. '%')
               ->orWhere('departure', 'like', '%'. request()->search. '%')
               ->paginate();
       }
       else {
           return $event = Event::paginate();
       }
   }

    public function saveImages($images)
    {
        $user = auth()->user();

        $fileName = $user->id.'eventImage'.random_int(100000, 999999). '.png';
        $decodeBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$images));
        file_put_contents('C:\OpenServer\domains\backEnd\storage\events/'.$fileName, $decodeBase64);
        $tmpFile = new File('C:\OpenServer\domains\backEnd\storage\events/'.$fileName);
        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        return $file->path();
    }

}
