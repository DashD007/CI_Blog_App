<?php $this->extend('layouts/app.php') ?>


<?php $this->section('content') ?>


<div class="container">
    <div class="comment-form-wrap pt-5">
        <?php if(session()->getFlashdata('create')): ?>
            <div class="alert alert-success">
                <p><?= session()->getFlashdata('create') ?></p>
            </div>
        <?php endif; ?>

        <h3 class="mb-2" style="color:#EAEAEA">Create a New Blog</h3>
        <form action="<?php echo base_url("/blog/create")?>" method="POST" class="p-5 w-75 bg-light mx-auto" style="border-radius:10px;" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="title">Title</label>

                <input type="text" placeholder="title" name="title"  class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="category" >Category</label>
                <select name="category_id" class="form-select" aria-label="Default select example" id="category">
                    <!-- <option selected>Categories</option> -->
                    <?php foreach($categories as $category):?>
                        <option value="<?= $category->id ?>"><?= $category->name?></option>
                    <?php endforeach ?>    

                </select>
            </div>
      
            <div class="form-group">
                <label for="image" >Image</label>

                <input type="file" name="image"  class="form-control" id="image">
            </div>

            <div class="form-group">
                <label for="content" >Description</label>
                <textarea placeholder="Description" name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group">
             <input type="submit" name="submit" value="Create Post" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>


<?php $this->endsection() ?>