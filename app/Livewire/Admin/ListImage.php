<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListImage extends Component
{
    use WithFileUploads;

    public $images;
    public $addNewImagesModal = false;
    public $addNewImageTypeModal = false;
    public $editImageModal = false;
    public $deleteImageModal = false;

    public $image_title_new;
    public $image_path_new;
    public $image_description_new;
    public $image_type_new;
    public $new_image_type;
    public $distinctTypes;
    public $edit_image_id;
    public $edit_image_title;
    public $edit_image_path;
    public $edit_old_image_path;
    public $edit_image_description;
    public $edit_image_type;

    public function openAddNewImagesModal()
    {
        Log::info('openAddNewImagesModal');
        $this->addNewImagesModal = true;
    }

    public function closeAddNewImagesModal()
    {
        $this->addNewImagesModal = false;
    }

    public function openAddNewImageTypeModal()
    {
        Log::info('openAddNewImageTypeModal');
        $this->addNewImageTypeModal = true;
    }

    public function closeAddNewImageTypeModal()
    {
        $this->addNewImageTypeModal = false;
    }

    public function openEditImageModal($id)
    {
        $image = Image::find($id);
        $this->edit_image_id = $image->id;
        $this->edit_image_title = $image->title;
        $this->edit_image_description = $image->description;
        $this->edit_image_type = $image->type;
        $this->edit_old_image_path = $image->path;
        $this->editImageModal = true;
    }

    public function closeEditImageModal()
    {
        $this->editImageModal = false;
    }

    public function openDeleteImageModal($id)
    {
        $this->edit_image_id = $id;
        $this->deleteImageModal = true;

    }

    public function closeDeleteImageModal()
    {
        $this->deleteImageModal = false;
    }

    public function store_image()
    {
        $this->validate([
            'image_title_new' => 'required',
            'image_path_new' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_description_new' => 'required',
            'image_type_new' => 'required',
        ]);

        $imageName = time() . '_' . $this->image_path_new->getClientOriginalName();

        $imagePath = $this->image_path_new->storeAs('public/assets/images', $imageName);
        Log::info('Image moved', ['image' => $imagePath]);

        $publicPath = 'assets/images/' . $imageName;
        Log::info('Image path', ['path' => $publicPath]);

        $image = new Image();
        $image->title = $this->image_title_new;
        $image->path = $publicPath;
        $image->description = $this->image_description_new;
        $image->type = $this->image_type_new;
        $image->save();

        $this->addNewImagesModal = false;
    }

    public function store_image_type()
    {
        $this->validate([
            'new_image_type' => 'required|unique:images,type',
        ]);

        $this->distinctTypes[] = $this->new_image_type;

        $this->addNewImageTypeModal = false;
    }

    public function update_image()
    {
        $this->validate([
            'edit_image_title' => 'required',
            'edit_image_description' => 'required',
            'edit_image_type' => 'required',
        ]);

        $image = Image::find($this->edit_image_id);
        $image->title = $this->edit_image_title;
        $image->description = $this->edit_image_description;
        $image->type = $this->edit_image_type;

        if ($this->edit_image_path) {
            $this->validate([
                'edit_image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $oldPath = $image->path;
            Storage::delete('public/' . $oldPath);
            Log::info('Old image deleted', ['path' => $oldPath]);

            $imageName = time() . '_' . $this->edit_image_path->getClientOriginalName();
            $imagePath = $this->edit_image_path->storeAs('public/assets/images', $imageName);
            $publicPath = 'assets/images/' . $imageName;
            $image->path = $publicPath;
        }

        $image->save();
        $this->edit_image_path = null;

        $this->editImageModal = false;
    }
    public function delete_image()
    {
        $image = Image::find($this->edit_image_id);
        Storage::delete('public/' . $image->path);
        $image->delete();

        $this->deleteImageModal = false;
    }

    public function render()
    {
        $this->images = Image::all();
        $this->distinctTypes = Image::distinct()->pluck('type');

        return view('livewire.admin.list-image', [
            'images' => $this->images,
            'distinctTypes' => $this->distinctTypes,
        ]);
    }
}
