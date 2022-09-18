<?php
namespace App\Traits\Backend\FileUpload;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
/**
 * 
 */
trait FileUploadTrait
{
    protected $destination;
    protected $imageWidth;
    protected $imageHeight;
    protected $requestFile;

    protected $id;
    protected $dbImageField;
    


    /**for private property only */
        private $extension;
        private $originalNameWithExtension;
        private $storableImageFileName;
        private $imageResize;
    /**for private property only */

    
    /*
    |---------------------------------------------------------------------------------------------
    |   Store Image
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory
        $this->storeImage();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
    

    public function storeImage() 
    {
        //its for full name, when we insert full name.. 
        // Get filename with extension
        //$originalNameWithExtension = strtolower($this->requestFile->getClientOriginalName());
        // Get file path
        //$fileNameWithSpace = pathinfo($originalNameWithExtension, PATHINFO_FILENAME);
        //its for full name, when we insert full name.. 



        // Get the original image extension
        $this->extension = strtolower($this->requestFile->getClientOriginalExtension());

        //Create unique file name
        $this->storableImageFileName =   $this->id.'.'.$this->extension;
        //$this->storableImageFileName =   str_replace(' ', '-', $fileNameWithSpace).'-'.time()."-".rand(100000,999999).'.'.$this->extension;
        //$this->storableImageFileName =   $fileNameWithSpace.'-'.time()."-".rand(100000,999999).'.'.$this->extension;

        // Refer image to method resizeImage
        $this->resizeAndStoreImage();
        return  $this->extension;
        return $this->storableImageFileName;
    }
    /*
    |---------------------------------------------------------------------------------------------
    | End image insert
    |---------------------------------------------------------------------------------------------
    */
       

    //its not using
    /* public function insertImage()
    {   
        if ($this->requestFile)
        {
            $this->extension    = strtolower($this->requestFile->getClientOriginalExtension());
            $this->originalName = strtolower($this->requestFile->getClientOriginalName());
            if ($this->extension != "jpg" && $this->extension != "jpeg" && $this->extension != "png" && $this->extension != "gif")
            {
                $this->extension = '';
            }
            else
            {
                $this->storableImageFileName = $this->id.".".$this->extension;
                $this->resizeAndStoreImage();
                return $this->extension;
            }
        }
        return "";
    } */
   //its not using




    /*
    |---------------------------------------------------------------------------------------------
    | Update Image
    | return image extension/imageName after inserting image by some property 
    | $this->destination, $this->imageWidth,$this->imageHeight,$this->requestFile,$this->dbImageField,//$this->id
        $this->destination  = ;  //its mandatory
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile         = ;  //its mandatory
        $this->dbImageField = ;  //its mandatory
        $this->updateImage();
    | by call this $this->updateImage() method....
    |---------------------------------------------------------------------------------------------
    */
        public function updateImage()
        {
            if ($this->requestFile)
            {
                if($this->dbImageField)
                {
                    $this->imageDelete();
                }

                
                //its for full name, when we insert full name.. 
                // Get filename with extension
                //$originalNameWithExtension = strtolower($this->requestFile->getClientOriginalName());
                // Get file path
                //$filenameWithSpace = pathinfo($originalNameWithExtension, PATHINFO_FILENAME);
                //its for full name, when we insert full name.. 




                // Get the original image extension
                $this->extension = strtolower($this->requestFile->getClientOriginalExtension());

                // Create unique file name
                $this->storableImageFileName     =   $this->id.'.'.$this->extension;
                //$this->storableImageFileName =   str_replace(' ', '-', $filenameWithSpace).'-'.time()."-".rand(100000,999999).'.'.$this->extension;
                //$this->storableImageFileName =   $filenameWithSpace.'-'.time()."-".rand(100000,999999).'.'.$this->extension;

                // Refer image to method resizeImage
                $this->resizeAndStoreImage();
                return $this->extension;
                return $this->storableImageFileName;
            }
            return "";
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End image update
    |---------------------------------------------------------------------------------------------
    */




    /*
    |--------------------------------------------------------------------------------------------------
    | Resize and Store Image
    | Image resize and upload  (this method use for store and update image) 
    |-------------------------------------------------------------------------------------------------- 
    */
        public function resizeAndStoreImage() 
        {
            // Resize image
            $this->imageResize = Image::make($this->requestFile)->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
            $constraint->aspectRatio();
            })->encode($this->extension);

            // Put image to storage
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}", $this->imageResize);

            if($save) {
                return $this->storableImageFileName;
            }
            return false;
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End image update
    |---------------------------------------------------------------------------------------------
    */




    /*
    |---------------------------------------------------------------------------------------------
    | Image delete
    | $this->destination , $this->dbImageField, //$this->id 
    |    $this->destination  = ;         //its mandatory
    |    $this->dbImageField = ;   //its mandatory
    |    $this->imageDelete();
    | by call this $this->imageDelete() method....
    |---------------------------------------------------------------------------------------------
    */
        public function imageDelete()
        {
            /* if(Storage::disk('public')->exists($this->destination.'/'.$this->dbImageField))
            {
                Storage::disk('public')->delete($this->destination.'/'.$this->dbImageField);
            }
            return true; */
            
            if(Storage::disk('public')->exists($this->destination.'/'.$this->id.".".$this->dbImageField))
            {
                Storage::disk('public')->delete($this->destination.'/'.$this->id.".".$this->dbImageField);
            } 
            return $this->id;
        }   
    /*
    |---------------------------------------------------------------------------------------------
    | End image delete
    |---------------------------------------------------------------------------------------------
    */






    //---------------------------not used ---------------------------------------------------------
    //---------------------------not used ---------------------------------------------------------

    /*
    |---------------------------------------------------------------------------------------------
    | Store Base64 image
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory
        $this->storeBase64Image();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function storeBase64Image() 
        {
            //$image_64 = $this->requestFile;//$data['photo']; //your base64 encoded data
            $this->extension = explode('/', explode(':', substr($this->requestFile, 0, strpos($this->requestFile, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($this->requestFile, 0, strpos($this->requestFile, ',')+1); 
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $this->requestFile); 
            $image = str_replace(' ', '+', $image); 
            $this->storableImageFileName = time()."-".rand(100000,999999).'.'.$this->extension;
            $this->resizeAndStoreImage();
            return $this->storableImageFileName;
            Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}", base64_decode($image));
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End base64 image insert
    |---------------------------------------------------------------------------------------------
    */




    /*
    |---------------------------------------------------------------------------------------------
    |   image upload from uploaded Image
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory only image name like  . 'image.png'
        $this->imageUploadFromUploadedImage();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function imageUploadFromUploadedImage() 
        {   
            $img = Image::make(asset('storage/products/'.$this->requestFile))->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');

            $this->storableImageFileName = time()."-".rand(100000,999999).'.jpg';
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}",$img);
            return $this->storableImageFileName;
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End image upload from uploaded image
    |---------------------------------------------------------------------------------------------
    */
    



    /*
    |---------------------------------------------------------------------------------------------
    |   upload image from Image link
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory
        $this->imageUploadFromImageLink();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function imageUploadFromImageLink() //CsvFile 
        {   
            $img = Image::make($this->requestFile)->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');

            $this->storableImageFileName = time()."-".rand(100000,999999).'.jpg';
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}",$img);
            return $this->storableImageFileName; 
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End upload image from image link
    |---------------------------------------------------------------------------------------------
    */



    /*
    |---------------------------------------------------------------------------------------------
    |   Update image from Image link
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory
        $this->dbImageField = ;
        $this->imageUpdateFromImageLink();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function imageUpdateFromImageLink() //CsvFile 
        {   
            if($this->dbImageField)
            {
                $this->imageDelete();
            }

            $img = Image::make($this->requestFile)->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');

            $this->storableImageFileName = time()."-".rand(100000,999999).'.jpg';
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}",$img);
            return $this->storableImageFileName; 
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End Update image from image link
    |---------------------------------------------------------------------------------------------
    */



    //---------------------------not used ---------------------------------------------------------
    //---------------------------not used ---------------------------------------------------------
    
    /*
    |---------------------------------------------------------------------------------------------
    |   default image upload.   but not working
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory only image name like  . 'image.png'
        $this->imageUploadFromImageLink();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function defaultImageUploadFromImageLink() //no-image-found 
        {   
            $img = Image::make(asset('storage/no-image-found/'.$this->requestFile))->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('png');

            $this->storableImageFileName = time()."-".rand(100000,999999).'.png';
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}",$img);
            return $this->storableImageFileName;
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End default image upload.
    |---------------------------------------------------------------------------------------------
    */
    


    
    /*
    |---------------------------------------------------------------------------------------------
    |   default image upload.   but not working
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->requestFile  = ;  //its mandatory only image name like  . 'image.png'
        $this->dbImageField = ;
        $this->defaultImageUpdateFromImageLink();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function defaultImageUpdateFromImageLink() //no-image-found 
        {   
            if($this->dbImageField)
            {
                $this->imageDelete();
            }

            $img = Image::make(asset('storage/no-image-found/'.$this->requestFile))->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('png');

            $this->storableImageFileName = time()."-".rand(100000,999999).'.png';
            $save = Storage::disk('public')->put("{$this->destination}/{$this->storableImageFileName}",$img);
            return $this->storableImageFileName;
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End default image upload.
    |---------------------------------------------------------------------------------------------
    */
    

}
