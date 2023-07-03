<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Event;
use App\Events_customs;
use App\Send_File;

class SendFileController extends Controller
{
    public function send(Request $request, $event, $product, $orderId)
    {
        return $this->checkURL($request, $event, $product, $orderId);
    }

    public function checkURL(Request $request, $event, $product, $orderId)
    {
        /**
         * Vérifie si $event et $product passés en paramètres de l'URL existent dans la base de données.
         * Vérifie également si le $product passé en paramètre de l'URL existe bien dans l'événement.
         */

        $foundEvent = Event::find($event);
        $foundProduct = Events_customs::find($product);

        if ($foundEvent && $foundProduct && $foundProduct->event_id === $event) {
            return view('sendfile', compact('foundEvent', 'foundProduct', 'orderId'));
        }

        abort(404);
    }



    public function handleSend(Request $request, $event, $product, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,jpg,png|max:10240',
        ], [
            'file.required' => 'Le champ fichier est obligatoire.',
            'file.file' => 'Le champ doit être un fichier.',
            'file.max' => 'La taille du fichier ne doit pas dépasser 10 Mo.',
            'file.mimes' => 'Les formats acceptés sont jpeg, jpg, png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!preg_match('/^[a-zA-Z0-9-]+$/', $orderId)) {
            abort(404);
        }

        // Création d'une nouvelle instance de l'événement
        $order_upload = new Send_File;

        $order_upload->event_id = $event;
        $order_upload->events_custom_id = $product;
        $order_upload->orderId = $orderId;

        if ($request->hasFile('file')) {
            $disk = Storage::disk('s3');
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            // Ajouter une partie unique au nom du fichier
            $name = $this->generateUniqueFileName($disk, 'orders/uploads/', $originalName);

            $filePath = 'orders/uploads/' . $name;
            $img = file_get_contents($file);
            $disk->put($filePath, $img, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }

            $order_upload->img = $filePath;
            $order_upload->save();

            

            /* Supprimer tous les fichiers du storage */
            /*$folderPath = 'orders/uploads/';
            $files = $disk->files($folderPath);

            foreach ($files as $file) {
                $disk->delete($file);
            }

            dd($disk->allFiles($folderPath));*/

            return view('sendfile');
        }
    }

    private function generateUniqueFileName($disk, $path, $fileName)
    {
        $newFileName = $fileName;
        $counter = 1;

        while ($disk->exists($path . $newFileName)) {
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $baseName = pathinfo($fileName, PATHINFO_FILENAME);

            $newFileName = $baseName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        return $newFileName;
    }
}
