<?php
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>php hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

  <h1 class="text-center"> Hotel List</h1>

  <form action="./index.php" method="GET">
    <label for="is_park">Parking:</label>
    <select name="is_park" id="is_park">
      <option value="all" <?php echo (isset($_GET['is_park']) && $_GET['is_park'] == 'all') ? 'selected' : ''; ?>>all</option>
      <option value="1" <?php echo (isset($_GET['is_park']) && $_GET['is_park'] == '1') ? 'selected' : ''; ?>>available</option>
      <option value="0" <?php echo (isset($_GET['is_park']) && $_GET['is_park'] == '0') ? 'selected' : ''; ?>>not available</option>
    </select>
    <label for="rank">Rank:</label>
    <select name="rank" id="rank">
      <option value="all" <?php echo (isset($_GET['rank']) && $_GET['rank'] == 'all') ? 'selected' : ''; ?>>all</option>
      <option value="1" <?php echo (isset($_GET['rank']) && $_GET['rank'] == '1') ? 'selected' : ''; ?>>1</option>
      <option value="2" <?php echo (isset($_GET['rank']) && $_GET['rank'] == '2') ? 'selected' : ''; ?>>2</option>
      <option value="3" <?php echo (isset($_GET['rank']) && $_GET['rank'] == '3') ? 'selected' : ''; ?>>3</option>
      <option value="4" <?php echo (isset($_GET['rank']) && $_GET['rank'] == '4') ? 'selected' : ''; ?>>4</option>
      <option value="5" <?php echo (isset($_GET['rank']) && $_GET['rank'] == '5') ? 'selected' : ''; ?>>5</option>
    </select>
    <button type="submit">Filter</button>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Parking</th>
        <th scope="col">Vote</th>
        <th scope="col">Distance to center</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      $filtered_hotels = array_filter($hotels, function ($hotel) {
        $park_filter = (!isset($_GET['is_park']) || $_GET['is_park'] == 'all' || $hotel['parking'] == $_GET['is_park']);
        $rank_filter = (!isset($_GET['rank']) || $_GET['rank'] == 'all' || $hotel['vote'] >= $_GET['rank']);

        return $park_filter && $rank_filter;
      });

       foreach ($filtered_hotels as $hotel) { ?>
      <tr>
        <th scope="row"><?php echo $i++ ?></th>
        <td> <?php echo $hotel['name'] ?></td>
        <td> <?php echo $hotel['description'] ?></td>
        <td> <?php if( $hotel['parking']) { echo 'avaible';} else{ echo 'not avaible';}?></td>
        <td> <?php echo $hotel['vote'] ?></td>
        <td> <?php echo $hotel['distance_to_center'] ?></td>
      </tr>
      <?php } ?>

    </tbody>
  </table>
</body>

</html>