<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>

<?php
$invoice = $_GET['id'];
global $wpdb;
$p_table = $wpdb->prefix . "purchase";
$r_table = $wpdb->prefix . "raw_materials";
$s_table = $wpdb->prefix . "suppliers";
$home_url = esc_url(admin_url('admin.php?page='));

$materials = $wpdb->get_results("SELECT * from $r_table");
$supplier = $wpdb->get_results("SELECT * from $s_table");
$purchase = $wpdb->get_results("SELECT * from $p_table where invoice_id=$invoice");
// echo "<pre>";
// print_r($purchase); exit;

$pid = [];




// if (isset($_POST['submit'])) {
// // echo "<pre>";
// // print_r($_POST); exit;
//   // $mat = $_POST['material'];
//   // $sup = $_POST['supplier'];
//   // $qnt = $_POST['quantity'];
//   // $pri = $_POST['price'];
//   // $inv = $_POST['inid'];
//   // $dte = $_POST['date'];
//   // $length = strlen($inv);
//   // if (is_numeric($inv)) {
//   //   foreach ($pri as $k => $d) {

//   //     #$p = $d;
//   //     $m = $mat[$k];
//   //     $s = $sup[$k];
//   //     $q = $qnt[$k];
//   //     $proid = $_SESSION["purchase_id"][$k];

//   //     #echo "$inv,$p,$m,$s,$q,$dte<br>";

//   //     $allnumber = is_numeric($m) && is_numeric($s) && is_numeric($q) && is_numeric($d) && $m != "xxx" && $s != "xxx";
//   //     if ($allnumber) {
//   //       $con->query("insert into purchase(invoice_id,price,material_id,supplier_id,quantity,date)values($inv,$d,$m,$s,$q,'$dte')");
// }
?>


<script>
  function validateForm() {
    let isValid = true;

    // Validate all quantity fields
    $("input[name^='quantity']").each(function (index, element) {
      let qVal = $.trim($(element).val());
      if (isNaN(qVal) || qVal == '') {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    // Validate all price fields
    $("input[name^='price']").each(function (index, element) {
      let pVal = $.trim($(element).val());
      if (isNaN(pVal) || pVal == '') {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    // Validate all material and supplier fields
    $("select[name^='material'], select[name^='supplier']").each(function (index, element) {
      let value = $(element).val();
      if (value === "xxx" || isNaN(value)) {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    return isValid;
  }

  function getprice(id, eid) {
    if (id != "xxx") {
      $.get("<?php echo home_url( '/' ) ?>" + "wp-json/purchase_api/purchase/" + id)
        .done(function(data) {
          console.log(data);
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + eid).val();
          console.log(id) +'here id';
          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + eid).val(price);
          }
          console.log(p);
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }

  function getp2(f) {
    let x = $("#material" + f).val();
    if (x != "xxx") {
      $.get("<?php echo home_url( '/' ) ?>" + "wp-json/purchase_api/purchase/" + x)
        .done(function(data) {
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + f).val();

          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + f).val(price);
            console.log(p, q, price);
          }
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }

  function errchk(idname) {
    let $inputElement = $("#" + idname);
    let matv = $inputElement.val();

    if (!isNaN(matv)) {
      $inputElement.css("border", "");
      console.log("The variable is a number.");
    } else {
      $inputElement.css("border", "2px solid red");
      console.log("The variable is not a number.");
    }
  }

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

          </ol>
        </div>
      </div>
      <div>
        <div class="card-primary">
          <div class="card-header " style="background-color:#563d7c">
            <h3 class="card-title text-light">Edit Purchase</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form onsubmit="return validateForm()" action="<?php echo esc_url(admin_url('admin-post.php'));?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Invoice ID</label>

                    <input type="hidden" name="action" value="helal_update_purchase">
                    <input readonly onkeyup="errinv()" value="<?php echo $purchase[0]->invoice_id ?>" type="text"
                      name="inid" class="form-control" id="inv1" placeholder="Enter title">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input readonly type="date" value="<?php echo $purchase[0]->date ?>" name="date"
                      class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                  </div>
                </div>
              </div>
              <div class="row">
                <table class="container-fluid table table-striped">
                  <thead class="bg-success text-light text-center">
                    <tr>
                      <th class="col-3">Materials</th>
                      <th class="col-3">Supplier</th>
                      <th class="col-3">Quantity</th>
                      <th class="col-2">Price</th>
                      <th class="col-1"></th>
                    </tr>
                  </thead>
                  <tbody id="purchase">
                    <?php
                    $ida = 1;
                    foreach ($purchase as $d) {
                      $xid = $d->id;
                      array_push($pid, $xid);
                      $_SESSION['purchase_id'] = $pid;
                      ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <select onblur="errchk('price<?php echo $ida ?>')" name="material[]"
                              id="material<?php echo $ida ?>"
                              onchange="getprice((this.value),<?php echo $ida ?>), errchk('material<?php echo $ida ?>'), errchk('price<?php echo $ida ?>')"
                              class="form-control">
                              <option value="xp">Select Material</option>

                              <?php foreach ($materials as $c) { ?>
                                <option value="<?php echo $c->id ?>" <?php
                                   if ($c->id == $d->material_id) {
                                     echo "selected";
                                   }
                                   ?>><?php echo $c->name . " " . $c->price . " Taka" ?>
                                </option>
                              <?php } ?>

                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <select onblur="errchk('price<?php echo $ida ?>')"
                              onchange="errchk('supplier<?php echo $ida ?>'), errchk('price<?php echo $ida ?>')"
                              name="supplier[]" id="supplier<?php echo $ida ?>" class="form-control">
                              <option value="xp">Select Supplier</option>

                              <?php foreach ($supplier as $c) { ?>
                                <option value="<?php echo $c->id ?>" <?php
                                   if ($c->id == $d->supplier_id) {
                                     echo "selected";
                                   }
                                   ?>><?php echo $c->company_name ?></option>
                              <?php } ?>

                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input onblur="errchk('price<?php echo $ida ?>')"
                              onkeyup="errchk('quantity<?php echo $ida ?>'), errchk('price<?php echo $ida ?>')"
                              type="text" name="quantity[]" onkeydown="getp2(<?php echo $ida ?>)"
                              value="<?php echo $d->quantity ?>" class="form-control" id="quantity<?php echo $ida ?>"
                              placeholder="Enter title">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input onkeyup="errchk('price<?php echo $ida ?>')" type="text" name="price[]"
                              value="<?php echo $d->price ?>" class="form-control" id="price<?php echo $ida ?>"
                              placeholder="Enter title">
                          </div>
                        </td>
                      </tr>
                      <?php $ida += 1;
                    } ?>
                  </tbody>
                  <tfoot>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <a href="#" onclick="addmore()" class="btn btn-primary">Add More</a>
                          </td>
                        </tr>
                      </tfoot>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer ">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<!-- /.content-wrapper -->


<script>
      let sl = 2;

      function addmore() {
        $(document).ready(function () {
          $('#purchase').on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
          });
        });
        let newRow = `
                          <tr>
                            <td>
                              <div class="form-group">
                                <select onblur="errchk('price${sl}')" name="material[]" id="material${sl}" class="form-control" onchange="getprice(this.value, ${sl}), errchk('material${sl}'), errchk('price${sl}')">
                                  <option value="xxx">Select Material</option>
                                  <?php foreach ($materials as $d) { ?>
                                      <option value="<?php echo $d->id ?>"><?php echo $d->name . " " . $d->price . " Taka" ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <select onblur="errchk('price${sl}')" name="supplier[]" id="supplier${sl}" class="form-control" onchange="errchk('supplier${sl}'), errchk('price${sl}')">
                                  <option value="xxx">Select Supplier</option>
                                  <?php foreach ($supplier as $d) { ?>
                                      <option value="<?php echo $d->id ?>"><?php echo $d->company_name ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input onblur="errchk('price${sl}')" type="text" name="quantity[]" id="quantity${sl}" class="form-control" placeholder="Enter quantity" onkeyup="getp2(${sl}), errchk('quantity${sl}'), errchk('price${sl}')">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="text" name="price[]" id="price${sl}" class="form-control" placeholder="Enter price" onkeyup="errchk('price${sl}')">
                              </div>
                            </td>
                            <td>
                            <div class="form-group">
                              <button type="button" class="btn btn-danger delete-row">Delete</button>
                            </div>
                          </td>
                          </tr>
                        `;
        $("#purchase").append(newRow);
        sl++;
      }
</script>