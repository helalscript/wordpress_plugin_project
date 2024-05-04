<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1> Add Material</h1>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="action" value="save_material">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="price" placeholder="price"><br>
    <input class="btn btn-primary" type="submit" value="Save">
</form>