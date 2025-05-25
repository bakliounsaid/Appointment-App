<?php

namespace App\Livewire\Admin\Product;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Show extends Component
{
    use WithFileUploads;

    public Product $product;
    public $available;

    public $images = [];
    public $newImages = [];

    public function rules()
    {
        return [
            'images' => 'required|array|min:1',
            'product.name_fr' => 'required|string|max:255',
            'product.name_ar' => 'required|string|max:255',
            'product.description_ar' => 'required|string|max:255',
            'product.description_fr' => 'required|string|max:255',
            'product.price' => 'required|numeric',
            'available' => 'required|boolean',
        ];
    }

    public function mount()
    {
        $this->available = $this->product->available ? true : false;
        foreach ($this->product->media as $media) {
            $this->images[] = $media->url;
        }
    }

    public function updatedNewImages()
    {
        foreach ($this->newImages as $file) {
            $this->images[] = $file;
        }
        $this->newImages = [];
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

 public function save()
    {

        try {
                    $this->validate();

            DB::transaction(function () {


                   $manager = ImageManager::gd();


                $keptUrls = array_filter($this->images, function ($item) {
                    return is_string($item);
                });
                $currentUrls = $this->product->media()->pluck('url')->toArray();
                $urlsToDelete = array_diff($currentUrls, $keptUrls);

                foreach ($urlsToDelete as $url) {
                 if (Storage::disk('public')->exists($url)) {
                     Storage::disk('public')->delete($url);
                }

                    $this->product->media()->where('url', $url)->delete();
                }

                foreach ($this->images as $image) {
                    if (is_object($image)) {
                        $readImage = $manager->read($image);
                        $encoded = $readImage->scale(600, 600)->encode(new WebpEncoder());

                        $fileName = 'products/' . md5($image->getFilename() . now()) . '.webp';

                        Storage::put($fileName, $encoded->__toString());

                        $media = new Media([
                            'url' => $fileName,
                            'type' => 'image',
                        ]);
                        $this->product->media()->save($media);
                    }
                }
                $this->product->available = $this->available;
                $this->product->save();
                alert()->success(__('Updated successfully'), __('Product updated successfully'));
                $this->redirectRoute('admin.product.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed update'),
                "text" => __('Could not update this product'),
                'icon' => "warning"
            ]);
        }
    }
    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.product.show');
    }
}
