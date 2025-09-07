<?php $this->extend('layouts/app.php') ?>


<?php $this->section('content') ?>


<!-- Start retroy layout blog posts -->
	<section class="section">
		<div class="container">
            <?php if(session()->getFlashdata('create')): ?>
                <div class="alert alert-success">
                    <p><?= session()->getFlashdata('create') ?></p>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('update')): ?>
                <div class="alert alert-success">
                    <p><?= session()->getFlashdata('update')?></p>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('delete')): ?>
                <div class="alert alert-success">
                    <p><?= session()->getFlashdata('delete')?></p>
                </div>
            <?php endif; ?>
            <div style="display:flex;flex-direction:row;justify-content:space-between; align-items: center; margin-bottom:5px;">
                <h3 class="mb-3" style="color:#fff">Category Master (<?= sizeof($categories) ?>)</h3>
                <?php if(in_array("category.create",session()->permissions)): ?>
                    <a href="<?= base_url('category/create'); ?>" style="border:1px solid #fff;border-radius:50%; width:40px;height:40px;text-align:center; font-size:24px; color:red">+</a>
                <?php endif; ?>
            </div>
            <?php if(in_array("category.list",session()->permissions)): ?>
                <table class="table mt-2" style="border-radius:10px; overflow: hidden;" id="categoryTable">
                    <thead class="table-light">
                    <tr>
                        <th>S no.</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-light">
                    <?php foreach($categories as $i => $category): ?>
                        <tr>
                        <td><?= ++$i?></td>
                        <td><?= $category->name ?></td>
                        <td><?= $category->created_at ?></td>
                        <td>
                            <div style="display:flex;flex-direction:row;gap:10px">		
                                <?php if(in_array("category.update",session()->permissions)): ?>							
                                    <button 
                                        class="btn btn-warning " 
                                        style="height:30px; width:30px; display:flex;align-items:center;justify-content:center" 
                                        onclick="window.location.href='<?= base_url('/category/update/' . $category->id .' '); ?>'">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if(in_array("category.delete",session()->permissions)): ?>
                                    <button 
                                        class="btn btn-danger " 
                                        style="height:30px; width:30px; display:flex;align-items:center;justify-content:center" 
                                        onclick="window.location.href='<?= base_url('/category/delete/' . $category->id); ?>'">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>
		</div>
	</section>
	<!-- End retroy layout blog posts -->

<?php if(in_array("category.list",session()->permissions)): ?>
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                pageLength: 10,
                lengthChange:false,
                
            }); // Enables pagination + search
        });
    </script>
<?php endif; ?>

<?php $this->endsection() ?>

