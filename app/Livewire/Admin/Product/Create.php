<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use WithFileUploads;

    public $nameFr;
    public $nameAr;
    public $descriptionAr;
    public $descriptionFr;
    public $images = [];
    public $previews = [];
    public $price;
    public $available = true;
    public $category;
    public $newImages = [];
    public $language;

    public function mount()
    {
        $this->language = app()->getLocale();
    }
    public function rules()
    {
        return [
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimetypes:image/jpeg,image/png,image/bmp,image/webp,image/svg+xml|max:2048',
            'nameFr' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'descriptionAr' => 'required|string|max:255',
            'descriptionFr' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|exists:Categories,id',
            'available' => 'required|boolean',
        ];
    }

    public function updatedNewImages()
    {
        $this->images = array_merge($this->images, $this->newImages);
        $this->newImages = [];
    }



    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }
    #[Computed()]
    public function categories()
    {
        return Category::get();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $product = Product::create([
                    'name_ar' => $this->nameAr,
                    'name_fr' => $this->nameFr,
                    'description_ar' => $this->descriptionAr,
                    'description_fr' => $this->descriptionFr,
                    'price' => $this->price,
                    'available' => $this->available,
                ]);

                $manager = ImageManager::gd();

                foreach ($this->images as $uploadedImage) {
                    $readImage = $manager->read($uploadedImage);
                    $encoded = $readImage->scale(600, 600)->encode(new WebpEncoder());

                    $fileName = 'products/' . md5($uploadedImage->getFilename() . now()) . '.webp';

                    Storage::put($fileName, $encoded->__toString());

                    $media = new Media([
                        'url' => $fileName,
                        'type' => 'image',
                    ]);
                    $product->category()->associate($this->category);
                    $product->media()->save($media);
                    $product->save();
                }

                alert()->success(__('Created successfully'), __('Product created successfully'));
                $this->redirectRoute('admin.product.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed creation'),
                "text" => __('Could not create this product'),
                'icon' => "warning"
            ]);
        }
    }



    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.product.create');
    }
}
