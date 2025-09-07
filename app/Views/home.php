<?php $this->extend('layouts/app.php') ?>


<?php $this->section('content') ?>


<!-- Start retroy layout blog posts -->
	<section class="section">
		<div class="container" style="margin-top:-50px;">
			<div style="display:flex;flex-direction:row; justify-content: space-between; align-items: center;">
				<?php if(isset(auth()->user()->id)): ?>
					<?php if(in_array("blog.create",session()->permissions)): ?>
						<a class="btn btn-danger mb-2" href="<?php echo base_url("/blog/create/view")?>">Add your blog</a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if(session()->getFlashdata('delete')): ?>
					<div class="alert alert-success mb-2">
						<p><?= session()->getFlashdata('delete') ?></p>
					</div>
				<?php endif; ?>
			</div>
			<div class="row" style="display:grid; grid-template-columns: repeat(3,1fr); gap:7px; padding:0px;">
				<?php foreach($posts as $post): ?>

					<a href="<?php echo base_url("blog/" . $post['id'] . " ") ?>" class="card" style="background: url('<?= base_url("public/assets/images/" . $post["coverImageURL"]) ?>') center/cover no-repeat;">
						<div class="text">
							<div style="display:flex;flex-direction:row; justify-content: space-between;">
								<span class="date"><?= $post['created_at'] ?></span>
								<?php if(isset(auth()->user()->id)): ?>
									<?php if(auth()->user()->id == $post['publishedBy']):?>
										<div style="display:flex;flex-direction:row;gap:10px">		
											<?php if(in_array("blog.update",session()->permissions)): ?>					
												<button 
													class="btn btn-warning " 
													style="height:30px; width:30px; display:flex;align-items:center;justify-content:center" 
													onclick="event.stopPropagation(); event.preventDefault(); window.location.href='<?= base_url('/blog/update/view/' . $post['id']); ?>'">

													<i class="bi bi-pencil"></i>
												</button>
											<?php endif;?>	
											<?php if(in_array("blog.delete",session()->permissions)): ?>
												<button 
													class="btn btn-danger " 
													style="height:30px; width:30px; display:flex;align-items:center;justify-content:center" 
													onclick="event.stopPropagation(); event.preventDefault(); window.location.href='<?= base_url(relativePath: '/blog/delete/' . $post['id']); ?>'">

													<i class="bi bi-trash"></i>
												</button>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<h2 style="
								display: -webkit-box;
								-webkit-line-clamp: 2;     /* show only 2 lines */
								-webkit-box-orient: vertical;
								overflow: hidden;
								text-overflow: ellipsis;
								"><?= $post['title'] ?></h2>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!-- End retroy layout blog posts -->

<?php $this->endsection() ?>

