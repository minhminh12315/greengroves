<?php

namespace App\Livewire\Admin;

use App\Mail\NoticeOfPromotions;
use App\Models\EmailNotification;
use Livewire\Component;
use App\Models\News as NewsModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Renderless;
use Livewire\WithFileUploads;

class News extends Component
{
    use WithFileUploads;
    public $news;
    public $news_title;
    public $news_description;
    public $news_image_path;
    public $news_id;
    public $news_old_image_path;

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

    // Log the public path
    Log::info('Public path of the image', ['public_path' => $public_path]);

    $new_news = new NewsModel();
    $new_news->title = $this->news_title;
    $new_news->description = $this->news_description;
    $new_news->path = $public_path;
    $new_news->save();

    $peopleToSendNotice = EmailNotification::all();

    foreach ($peopleToSendNotice as $person) {
        Log::info('Sending email to', ['email' => $person->email]);
        Mail::to($person->email)->send(new NoticeOfPromotions([
            'title' => $this->news_title,
            'description' => $this->news_description,
            'path' => $public_path // Fixed reference to $public_path
        ]));
    }
    $this->news_title = '';
    $this->news_description = '';
    $this->news_image_path = '';
    session()->flash('message', 'News Created Successfully.');
    $this->dispatch('closeModal');
    $this->mount();
    $this->reset('news_title','news_description','news_image_path');
}

    public function openEditNewsModal($id)
    {
        $news = NewsModel::find($id);
        $this->news_id = $news->id;
        $this->news_title = $news->title;
        $this->news_description = $news->description;
        $this->news_old_image_path = $news->path;
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
            'path.required' => 'The News Image field is required.',
            'news_image_path.image' => 'The News Image must be an image.',
            'news_image_path.mimes' => 'The News Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'news_image_path.max' => 'The News Image must not be greater than 2048 kilobytes.',
        ]);

        $imageName = time() . '.' . $this->news_image_path->extension();
        $this->news_image_path->storeAs('public/assets/images', $imageName);
        $public_path = 'assets/images/' . $imageName;

        $news = NewsModel::find($this->news_id);
        $news->title = $this->news_title;
        $news->description = $this->news_description;
        $news->path = $public_path;
        $news->save();

        session()->flash('message', 'News Updated Successfully.');
        $this->dispatch('closeModal');
        $this->news_image_path = null;
        $this->mount();

    }

    #[Renderless]
    public function openDeleteNewsModal($id)
    {
        $this->news_id = $id;
        Log::info('News ID', ['id' => $this->news_id]);
    }
    public function delete_image()
    {
        $news = NewsModel::find($this->news_id);
        $news->delete();
        session()->flash('message', 'News Deleted Successfully.');
        $this->dispatch('closeModal');
        $this->mount();
    }
    public function resetAll() {
        $this->news_title = '';
        $this->news_description = '';
        $this->news_image_path = null;
        $this->news_id = null;
        $this->news_old_image_path = null;
        $this->mount(); // Ensure this is a collection
    }
    public function mount()
    {
        $this->news = NewsModel::all(); // Ensure this is a collection
    }

    public function render()
    {
        return view('livewire.admin.news');
    }
}