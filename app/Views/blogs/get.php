<?php $this->extend('layouts/app.php') ?>


<?php $this->section('content') ?>

<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('<?php echo base_url('public/assets/images/' . $postData->coverImageURL . " ") ?>');">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-6">
          <div class="post-entry text-center"> 
            <h1 class="mb-4"><?= $postData->title ?></h1>
            <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 me-3 d-inline-block">											
                    <img style="aspect-ratio: 1/1; border-radius:50%; height: 30px;" src="<?= 'https://avatar.iran.liara.run/username?username=' . $postData->username; ?>" alt="user-avatar">
                </figure>
              <span class="d-inline-block mt-1"><?= $postData->username; ?></span>
              <span>&nbsp;-&nbsp; <?= $postData->created_at; ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">

      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-8 main-content">

          <div class="post-content-body">
            <p style="color:#EAEAEA"><?= $postData->content; ?></p>
          </div>


          <div class="pt-5">
            <p>Categories:  <span style="color:#EAEAEA"><?= $postData->category?></span></p>
          </div>



          <div class="pt-5 comment-wrap">
            <h3 class="mb-5 heading" style="color:#EAEAEA"><?= sizeof($comments); ?> Comments</h3>
            <ul class="comment-list">
              <?php foreach($comments as $comment): ?>
                <li class="comment" style="display:flex; flex-direction: row; gap:10px;">
                  <div class="">
                    <img style="border-radius:50%; height: 30px; width:30px;" src="<?= 'https://avatar.iran.liara.run/username?username=' . $comment->username; ?>" alt="user-avatar">
                  </div>
                  <div class="comment-body">
                    <h3 style="color:#EAEAEA"><?= $comment->username?></h3>
                    <div class="meta"><?= $comment->created_at?></div>
                    <p style="color:#EAEAEA"><?= $comment->content?></p>
                  </div>
                </li>
              <?php endforeach; ?>

      
            </ul>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
              <?php if(session()->getFlashdata('create')): ?>
                  <div class="alert alert-success">
                      <p><?= session()->getFlashdata('create') ?></p>
                  </div>
              <?php endif; ?>
              <h3 class="mb-5" style="color:#EAEAEA">Leave a comment</h3>
              <form action="<?= base_url("/comment/save/{$postData->id}"); ?>" class="p-5 bg-light" method="POST" style="border-radius:10px">
                <div class="form-group">
                  <label for="message">Comment</label>
                  <textarea name="content" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn btn-primary">
                </div>

              </form>
            </div>
          </div>

        </div>

        <!-- END main-content -->

        <div class="col-md-12 col-lg-4 sidebar">
          <div class="sidebar-box" style="background-color:#3c3c3c;">
            <h3 class="heading" style="color:#EAEAEA">Popular Blogs</h3>
            <div class="post-entry-sidebar">
              <ul>
                <?php foreach($popularBlogs as $popularBlog): ?>
                    <li>
                    <a href="<?= base_url("blog/$popularBlog->id"); ?>">
                        <img src="<?= base_url("public/assets/images/" . $popularBlog->coverImageURL . " ") ?>" alt="Image placeholder" class="me-4 rounded">
                        <div class="text">
                            <h4 style="color:#EAEAEA"><?= $popularBlog -> title; ?></h4>
                            <div class="post-meta">
                                <span class="mr-2"><?= $popularBlog->created_at?> </span>
                            </div>
                        </div>
                    </a>
                    </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <!-- END sidebar-box -->

          <div class="sidebar-box" style="background-color:#3c3c3c;">
            <h3 class="heading" style="color:#EAEAEA">Categories</h3>
            <ul class="categories">
                <?php foreach($categories as $category): ?>
                    <li><a href="#" style="color:#EAEAEA"><?= $category->name?> <span>(<?= $category->count?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
          </div>
          <!-- END sidebar-box -->
        </div>
        <!-- END sidebar -->
      </div>
    </div>
  </section>


<?php $this->endsection() ?>