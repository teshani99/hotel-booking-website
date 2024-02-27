<?php
session_start();
require "connection.php";
if (isset($_SESSION['hotel'])) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.css" rel="stylesheet" />
    <title>Admin Panel</title>
    <style>
      body {
        background-color: #f8f9fa;
      }

      .container-fluid {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .btn-success,
      .badge.bg-success {
        background-color: #FFA500;
        border-color: #FFA500;
      }

      .btn-danger,
      .badge.bg-danger {
        background-color: #ffffff;
        border-color: #FFA500;
        color: #FFA500;
      }

      .btn-success:hover,
      .btn-danger:hover,
      .btn-success:active,
      .btn-danger:active {
        background-color: #FFA500;
        border-color: #FFA500;
        color: #fff;
      }

      .table {
        background-color: #ffffff;
      }
      .btn_logout{
        position: absolute;
        right: 20px;
        top: 20px;
      }
    </style>
  </head>

  <body>

    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
      <div class="row">
        <div>
          <h2 class="mb-4 text-center">User Details</h2>
          <button class="btn-danger btn_logout btn" onclick="hotelLogout()">LogOut</button>
          <table class="table text-center">
            <thead>
              <tr>
                <th class="col-1">Name</th>
                <th class="col-1">Email</th>
                <th class="col-2">Contact Number</th>
                <th class="col-1">Number of Guests</th>
                <th class="col-1">Number of Days</th>
                <th class="col-2">Hotel Name</th>
                <th class="col-1">Package Name</th>
                <th class="col-1">Payment Method</th>
                <th class="col-2"></th>
              </tr>
            </thead>
            <tbody>

              <?php
              $result = Database::search("SELECT *,booking.id AS b_id FROM booking 
              INNER JOIN package ON booking.package_id=package.id
              INNER JOIN hotel ON package.hotel_id=hotel.id
              INNER JOIN payment ON booking.payment_id=payment.id
              WHERE hotel.id='" . $_SESSION['hotel']['id'] . "' AND status_id = '1' ");

              while ($data = $result->fetch_assoc()) {
              ?>
                <tr style="cursor: pointer">
                  <td><?= $data['user_name'] ?></td>
                  <td><?= $data['email'] ?></td>
                  <td><?= $data['contact'] ?></td>
                  <td><?= $data['no_of_guests'] ?></td>
                  <td><?= $data['days'] ?></td>
                  <td><?= $data['name'] ?></td>
                  <td><?= $data['package'] ?></td>
                  <td><?= $data['method'] ?></td>
                  <td class="d-flex justify-content-center gap-4">
                    <button class="btn btn-success" onclick="responseForBooking('<?= $data['b_id'] ?>',2);">Accept</button>
                    <button class="btn btn-danger" onclick="responseForBooking('<?= $data['b_id'] ?>',3);">Reject</button>
                  </td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>


        <div class="mt-5">
          <h2 class="mb-4 text-center">User Status</h2>
          <table class="table text-center">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result1 = Database::search("SELECT * FROM booking 
               INNER JOIN package ON booking.package_id=package.id
               INNER JOIN hotel ON package.hotel_id=hotel.id
              WHERE hotel.id='" . $_SESSION['hotel']['id'] . "' AND status_id!='1'");

              while ($data1 = $result1->fetch_assoc()) {
              ?>
                <tr>
                  <td><?= $data1['user_name'] ?></td>
                  <td><?= $data1['email'] ?></td>
                  <td>
                    <?php
                    if ($data1['status_id'] == 2) {
                    ?>
                      <span class="badge bg-success">Accepted</span>
                    <?php
                    } else if ($data1['status_id'] == 3) {
                    ?>
                      <span class="badge bg-danger">Rejected</span>
                    <?php
                    }
                    ?>
                  </td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnv1QzFjXfEX3LsAVZ" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location:index.php");
}

?>