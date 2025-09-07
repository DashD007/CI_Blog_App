<?php $this->extend("layouts/app.php");?>

<?php $this->section('content'); ?>

<div class="container">
    <div class="comment-form-wrap pt-5">

        <h3 class="mb-2" style="color:#EAEAEA">Update Role</h3>
        <form action="<?php echo base_url("/role/update/" . $roleData->id)?>" method="POST" class="p-5 w-75 bg-light mx-auto" style="border-radius:10px;" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="name">Name</label>

                <input type="text" placeholder="Name" name="name"  class="form-control" id="name" value="<?= $roleData->name ?>">
            </div>

            <div class="dropdown form-group">
                <label for="category" >Permissions to control users</label>
                <div class="multiselect-container users-permissions form-control" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="px-3 w-100" style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="text-muted">Select options...</span>
                        <span class="text-muted" style="font-size: 24px;">˅</span>
                    </div>
                </div>
                <!-- Dropdown menu -->
                <ul class="dropdown-menu p-2" style="width: 100%;">
                    <li><label class="dropdown-item"><input name="users-permissions[]" type="checkbox" value="user.list" class="form-check-input me-2" id="List" <?= in_array("user.list",$permissionData) ? 'checked' : ''; ?>>List</label></li>
                    <li><label class="dropdown-item"><input name="users-permissions[]" type="checkbox" value="user.create" class="form-check-input me-2" id="Create" <?= in_array("user.create",$permissionData) ? 'checked' : ''; ?>>Create</label></li>
                    <li><label class="dropdown-item"><input name="users-permissions[]" type="checkbox" value="user.update" class="form-check-input me-2" id="Update" <?= in_array("user.update",$permissionData) ? 'checked' : ''; ?>>Update</label></li>
                    <li><label class="dropdown-item"><input name="users-permissions[]" type="checkbox" value="user.delete" class="form-check-input me-2" id="Delete" <?= in_array("user.delete",$permissionData) ? 'checked' : ''; ?>>Delete</label></li>
                    <li><label class="dropdown-item"><input name="users-permissions[]" type="checkbox" value="user.count" class="form-check-input me-2" id="Count" <?= in_array("user.count",$permissionData) ? 'checked' : ''; ?>>Count</label></li>

                </ul>
            </div>

            <!-- Dropdown wrapper -->
            <div class="dropdown form-group">
                <!-- Input-like container -->
                <label class="form-label">Permissions to control roles</label>
                <div class="multiselect-container form-control w-100 roles-permissions" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="px-3 w-100" style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="text-muted">Select options...</span>
                    <span class="text-muted" style="font-size: 24px;">˅</span>
                </div>
                </div>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu p-2" style="width: 100%;">
                <li><label class="dropdown-item"><input name="roles-permissions[]" type="checkbox" value="role.list" class="form-check-input me-2" id="List" <?= in_array("role.list",$permissionData) ? 'checked' : ''; ?>>List</label></li>
                <li><label class="dropdown-item"><input name="roles-permissions[]" type="checkbox" value="role.create" class="form-check-input me-2" id="Create" <?= in_array("role.create",$permissionData) ? 'checked' : ''; ?>>Create</label></li>
                <li><label class="dropdown-item"><input name="roles-permissions[]" type="checkbox" value="role.update" class="form-check-input me-2" id="Update" <?= in_array("role.update",$permissionData) ? 'checked' : ''; ?>>Update</label></li>
                <li><label class="dropdown-item"><input name="roles-permissions[]" type="checkbox" value="role.delete" class="form-check-input me-2" id="Delete" <?= in_array("role.delete",$permissionData) ? 'checked' : ''; ?>>Delete</label></li>
                <li><label class="dropdown-item"><input name="roles-permissions[]" type="checkbox" value="role.count" class="form-check-input me-2" id="Count" <?= in_array("role.count",$permissionData) ? 'checked' : ''; ?>>Count</label></li>
                </ul>
            </div>

            <!-- Dropdown wrapper -->
            <div class="dropdown form-group">
                <!-- Input-like container -->
                <label class="form-label">Permissions to control categories</label>
                <div class="multiselect-container form-control w-100 categories-permissions"  id="" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="px-3 w-100" style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="text-muted">Select options...</span>
                    <span class="text-muted" style="font-size: 24px;">˅</span>
                </div>
                </div>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu p-2" style="width: 100%;">
                <li><label class="dropdown-item"><input name="categories-permissions[]" type="checkbox" value="category.list" class="form-check-input me-2" id="List" <?= in_array("category.list",$permissionData) ? 'checked' : ''; ?>>List</label></li>
                <li><label class="dropdown-item"><input name="categories-permissions[]" type="checkbox" value="category.create" class="form-check-input me-2" id="Create" <?= in_array("category.create",$permissionData) ? 'checked' : ''; ?>>Create</label></li>
                <li><label class="dropdown-item"><input name="categories-permissions[]" type="checkbox" value="category.update" class="form-check-input me-2" id="Update" <?= in_array("category.update",$permissionData) ? 'checked' : ''; ?>>Update</label></li>
                <li><label class="dropdown-item"><input name="categories-permissions[]" type="checkbox" value="category.delete" class="form-check-input me-2" id="Delete" <?= in_array("category.delete",haystack: $permissionData) ? 'checked' : ''; ?>>Delete</label></li>
                <li><label class="dropdown-item"><input name="categories-permissions[]" type="checkbox" value="category.count" class="form-check-input me-2" id="Count" <?= in_array("category.count",$permissionData) ? 'checked' : ''; ?>>Count</label></li>
                </ul>
            </div>

            <!-- Dropdown wrapper -->
            <div class="dropdown form-group">
                <!-- Input-like container -->
                <label class="form-label">Permissions to control blogs</label>
                <div class="multiselect-container form-control w-100 blogs-permissions"  data-bs-toggle="dropdown" aria-expanded="false">
                <div class="px-3 w-100" style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="text-muted">Select options...</span>
                    <span class="text-muted" style="font-size: 24px;">˅</span>
                </div>
                </div>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu p-2" style="width: 100%;">
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.list" class="form-check-input me-2" id="List" <?= in_array("blog.list",$permissionData) ? 'checked' : ''; ?>>List</label></li>
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.create" class="form-check-input me-2" id="Create" <?= in_array("blog.create",$permissionData) ? 'checked' : ''; ?>>Create</label></li>
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.update" class="form-check-input me-2" id="Update" <?= in_array("blog.update",$permissionData) ? 'checked' : ''; ?>>Update</label></li>
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.delete" class="form-check-input me-2" id="Delete" <?= in_array("blog.delete",$permissionData) ? 'checked' : ''; ?>>Delete</label></li>
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.count" class="form-check-input me-2" id="Count" <?= in_array("blog.count",$permissionData) ? 'checked' : ''; ?>>Count</label></li>
                <li><label class="dropdown-item"><input name="blogs-permissions[]" type="checkbox" value="blog.get" class="form-check-input me-2" id="Get" <?= in_array("blog.get",$permissionData) ? 'checked' : ''; ?>>Get</label></li>
                </ul>
            </div>
            

            <div class="form-group">
                <input type="submit" name="submit" value="Update Role" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>


<?php $this->endsection(); ?>