<?php

namespace App\Services;

use App\Models\FileManagerTrash;
use Illuminate\Support\Facades\DB;
use LivewireFilemanager\Filemanager\Models\Media;

class FileManagerTrashService
{
    /**
     * Envoyer un fichier dans la corbeille.
     */
    public function trash(Media $media): void
    {
        // Ne rien faire s'il est déjà dans la corbeille
        if ($media->deleted_at !== null) {
            return;
        }

        FileManagerTrash::create([
            'media_id'   => $media->id,
            'folder_id'  => $media->model_id,
            'name'       => $media->name,
            'deleted_by' => auth()->id(),
            'deleted_at' => now(),
        ]);

        // On marque le média comme étant dans la corbeille.
        // IMPORTANT : on n'appelle PAS $media->delete()
        DB::table('media')
            ->where('id', $media->id)
            ->update([
                'deleted_at' => now(),
            ]);
    }

    /**
     * Restaurer un fichier.
     */
    public function restore(FileManagerTrash $trash): void
    {
        $media = Media::withoutGlobalScope('not_trashed')
            ->find($trash->media_id);

        if (!$media) {
            throw new \RuntimeException(
                'Le fichier original n’existe plus.'
            );
        }

        DB::transaction(function () use ($media, $trash) {

            $media->update([
                'deleted_at' => null,
            ]);

            $trash->delete();
        });
    }

    /**
     * Supprimer définitivement un fichier.
     */
    public function forceDelete(FileManagerTrash $trash): void
    {
        $media = Media::find($trash->media_id);

        if ($media) {
            // Cette fois, on appelle volontairement delete().
            // Spatie supprimera le fichier physique.
            $media->delete();
        }

        $trash->delete();
    }
}
