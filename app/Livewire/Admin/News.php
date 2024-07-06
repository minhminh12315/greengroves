<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\News as NewsModel;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class News extends Component
{
    use WithFileUploads;
    public $news;
    public $AddNewsModal = false;
    public $EditNewsModal = false;
    public $DeleteNewsModal = false;
    public $news_title;
    public $news_description;
    public $news_image_path;
    public $news_id;
    public $news_old_image_path;

    public function openAddNewsModal()
    {
        $this->AddNewsModal = true;
    }

    public function closeAddNewsModal()
    {
        $this->AddNewsModal = false;
    }
    public function store_news()
    {
        $this->validate([
            'news_title' => 'required',
            'news_description' => 'required',
            'news_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'news_title.required' => 'The News Title field is required.',
            'news_description.required' => 'The News Description field is required.',
            'news_image_path.required' => 'The News Image field is required.',
            'news_image_path.image' => 'The News Image must be an image.',
            'news_image_path.mimes' => 'The News Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'news_image_path.max' => 'The News Image must not be greater than 2048 kilobytes.',
        ]);

        $imageName = time() . '.' . $this->news_image_path->extension();
        $this->news_image_path->storeAs('public/assets/images', $imageName);
        $public_path = 'assets/images/' . $imageName;

        $new_news = new NewsModel();
        $new_news->title = $this->news_title;
        $new_news->description = $this->news_description;
        $new_news->path = $public_path;
        $new_news->save();

        $this->closeAddNewsModal();
        session()->flash('message', 'News Created Successfully.');
        $this->mount();
    }

    public function openEditNewsModal($id)
    {
        $this->EditNewsModal = true;
        $news = NewsModel::find($id);
        $this->news_id = $news->id;
        $this->news_title = $news->news_title;
        $this->news_description = $news->news_description;
        $this->news_old_image_path = $news->news_image_path;
        $this->news_image_path = $news->news_image_path;
    }

    public function closeEditNewsModal()
    {
        $this->EditNewsModal = false;
    }

    public function update_news()
    {
        $this->validate([
            'news_title' => 'required',
            'news_description' => 'required',
            'news_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'news_title.required' => 'The News Title field is required.',
            'news_description.required' => 'The News Description field is required.',
            'news_image_path.required' => 'The News Image field is required.',
            'news_image_path.image' => 'The News Image must be an image.',
            'news_image_path.mimes' => 'The News Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'news_image_path.max' => 'The News Image must not be greater than 2048 kilobytes.',
        ]);

        $imageName = time() . '.' . $this->news_image_path->extension();
        $this->news_image_path->storeAs('public/assets/images', $imageName);
        $public_path = 'assets/images/' . $imageName;

        $news = NewsModel::find($this->news_id);
        $news->news_title = $this->news_title;
        $news->news_description = $this->news_description;
        $news->news_image_path = $public_path;
        $news->save();

        $this->closeEditNewsModal();
        session()->flash('message', 'News Updated Successfully.');
        $this->mount();
    }
    public function openDeleteNewsModal($id)
    {
        $this->DeleteNewsModal = true;
        $this->news_id = $id;
        Log::info('News ID', ['id' => $this->news_id]);
    }
    public function delete_image()
    {
        $news = NewsModel::find($this->news_id);
        $news->delete();
        $this->closeDeleteNewsModal();
        session()->flash('message', 'News Deleted Successfully.');
        $this->mount();
    }
    public function closeDeleteNewsModal()
    {
        $this->DeleteNewsModal = false;
    }
    public function mount()
    {
        $this->news = NewsModel::all(); // Ensure this is a collection
    }

    public function render()
    {
        return view('livewire.admin.news', ['news' => $this->news]);
    }
}
