<?php
include('includes/header.php');
include('config/connection.php');

if (isset($_POST['register_delete_btn'])) {
    $delete_id = $_POST['delete_id'];

    $delete_query = "DELETE FROM Entries WHERE id = '$delete_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Delete failed: " . mysqli_error($conn);
    }
}
if (isset($_GET['delete_all']) && $_GET['delete_all'] == 1) {
    $delete_all_query = "DELETE FROM Entries";
    $delete_all_result = mysqli_query($conn, $delete_all_query);

    if ($delete_all_result) {
        header("Location: index.php?deleted_all=1");
        exit();
    } else {
        echo "Failed to delete all entries: " . mysqli_error($conn);
    }
}

$totals_query = "SELECT 
                    SUM(acc_credit_new) AS total_credit, 
                    SUM(acc_debit_new) AS total_debit 
                 FROM Entries";
$totals_result = mysqli_query($conn, $totals_query);
$totals = mysqli_fetch_assoc($totals_result);
$total_credit = $totals['total_credit'] ?? 0;
$total_debit = $totals['total_debit'] ?? 0;
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Account CRUD
                        <span class="ms-2 text-success">Total New Credit:<?php echo number_format($total_credit, 2); ?></span>
                        <span class="ms-3 text-danger">Total New Debit:<?php echo number_format($total_debit, 2); ?></span>
                        <a href="newEntries.php" class="btn btn-primary float-end ms-2">New Entries</a>
                        <a href="index.php?delete_all=1" class="btn btn-danger float-end ms" onclick="return confirm('Are you sure you want to delete all entries?');">Delete All Entries</a>
                    </h3>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Account</th>
                                <th scope="col">Narration</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Credit Old Value</th>
                                <th scope="col">Debit old Value</th>
                                <th scope="col">Credit New Value</th>
                                <th scope="col">Debit New Value</th>
                                <th scope="col">Audit</th>
                                <th scope="col">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $acc_get_query = "SELECT * FROM Entries";
                            $acc_get_query_result = mysqli_query($conn, $acc_get_query);

                            if (mysqli_num_rows($acc_get_query_result) > 0) {
                                while ($row = mysqli_fetch_assoc($acc_get_query_result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['acc_name']; ?></td>
                                        <td><?php echo $row['acc_narration']; ?></td>
                                        <td><?php echo $row['acc_currency']; ?></td>
                                        <td><?php echo $row['acc_credit_old']; ?></td>
                                        <td><?php echo $row['acc_debit_old']; ?></td>
                                        <td><?php echo $row['acc_credit_new'] ?? 0; ?></td>
                                        <td><?php echo $row['acc_debit_new'] ?? 0; ?></td>

                                        <td>
                                            <a href="audit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Audit</a>
                                        </td>

                                        <td>
                                            <form action="index.php" method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="register_delete_btn" class="btn btn-danger">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr>
                                <td colspan="10" class="text-center bg-dark text-white fw-bold">No Data Available</td>
                              </tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>





<?php
include('includes/footer.php');
?>