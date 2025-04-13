<?php 
session_start(); 
require "../layouts/header.php"; 
require "../../config/config.php"; 

if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php'</script>";
    exit();
}

$adminname = $_SESSION['adminname'];

$stmt = $conn->prepare("SELECT * FROM requests WHERE author = :author");
$stmt->bindParam(':author', $adminname);
$stmt->execute();
$allRequests = $stmt->fetchAll(PDO::FETCH_OBJ);
?>  

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Requests</h5>

        <table class="table mt-3">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Go to this Property</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($allRequests) > 0) : ?>
              <?php foreach ($allRequests as $request) : ?>
                <tr>
                  <th scope="row"><?php echo $request->id; ?></th>
                  <td><?php echo htmlspecialchars($request->name); ?></td>
                  <td><?php echo htmlspecialchars($request->email); ?></td>
                  <td><?php echo htmlspecialchars($request->phone); ?></td>
                  <td>
                    <a href="http://localhost/homeland/property-details.php?id=<?php echo $request->prop_id; ?>" class="btn btn-success text-center">Go</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5">
                  <div class="alert alert-success bg-success text-white text-center">
                    You don't have any requests just yet
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
