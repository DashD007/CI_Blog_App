<?php $this->extend("layouts/app.php");?>

<?php $this->section('content'); ?>

<div class="container">
    <div class="comment-form-wrap pt-5">
        <h3 class="mb-2" style="color:#EAEAEA">Update Category</h3>
        <form action="<?php echo base_url("/category/update/". $data->id . " ")?>" method="POST" class="p-5 w-75 bg-light mx-auto" style="border-radius:10px;" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="name">Name</label>

                <input type="text" placeholder="Name" name="name"  class="form-control" id="name" value="<?= $data->name ?>">
            </div>
            
            <div class="form-group">
             <input type="submit" name="submit" value="Update Category" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>


<?php $this->endsection(); ?>