<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
    <input type="hidden" name="action" value="save_suppliers"><br>
    <input type="text" name="company_name" placeholder="Name"><br><br>
    <input type="text" name="email" placeholder="Email"><br><br>
    <input type="text" name="phone" placeholder="Phone"><br><br>
    <input type="text" name="address" placeholder="Address"><br><br>
    <input type="text" name="contact_person" placeholder="Contact Person"><br><br>
    <input type="text" name="bank_info" placeholder="Bank Info"><br><br>

    <input class="btn btn-primary" type="submit"  value="Save">
</form>
