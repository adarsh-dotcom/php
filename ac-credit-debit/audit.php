<?php
include('includes/header.php');
include('config/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_id_query = "SELECT * FROM Entries WHERE id = $id";
    $get_id_result = mysqli_query($conn, $get_id_query);

    if (mysqli_num_rows($get_id_result) > 0) {
        $row = mysqli_fetch_assoc($get_id_result);
        ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Entry (Audit)</h4>
                        </div>
                        <div class="card-body">
                            <form action="update.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">

                                <div class="mb-3">
                                    <label class="form-label">Account</label>
                                    <input type="text" class="form-control" name="acc_name" value="<?php echo $row['acc_name']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Narration</label>
                                    <input type="text" class="form-control" name="acc_narration" value="<?php echo $row['acc_narration']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Currency</label>
                                    <input type="text" class="form-control" name="acc_currency" value="<?php echo $row['acc_currency']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Credit New Value</label>
                                    <input type="number" class="form-control" name="acc_credit" value="<?php echo $row['acc_credit_new']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Debit New Value</label>
                                    <input type="number" class="form-control" name="acc_debit" value="<?php echo $row['acc_debit_new']; ?>">
                                </div>

                                <button type="submit" name="update_btn" class="btn btn-success">Update Data</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo "<div class='alert alert-warning'>No data found for this ID.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>No ID specified.</div>";
}

include('includes/footer.php');
?>
