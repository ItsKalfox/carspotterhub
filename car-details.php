<?php
require_once __DIR__ . '/db/config.php';

$car_id = isset($_GET['car_id']) ? $_GET['car_id'] : 0;

if ($car_id > 0) {
    $cars = "SELECT * FROM cars WHERE car_id = $car_id";
    $result = $conn->query($cars);
    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
        $images_query = "SELECT image_url FROM images WHERE car_id = $car_id";
        $images_result = $conn->query($images_query);
        $images = [];
        if ($images_result->num_rows > 0) {
            while ($row = $images_result->fetch_assoc()) {
                $images[] = $row['image_url'];
            }
        } else {
            $error = "No images found for this car.";
        }
    } else {
        $error = "Car not found.";
    }
} else {
    $error = "Invalid car ID.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/includes/header.php';?>
    <title>Car Details</title>
    <link rel="stylesheet" href="assets/css/styles_2.css">
    <link rel="icon" href="assets/css/favicon.png" type="image/png">
</head>

<body>

    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <?php
    $sql = "SELECT image_url FROM images WHERE car_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image_url'];
    }
    ?>

    <div class="container">
        <div class="car_details_carousel_container">
            <div class="car_details_carousel">
                <?php foreach ($images as $index => $image): ?>
                <div class="car_details_slide <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Car Image <?php echo $index + 1; ?>">
                </div>
                <?php endforeach; ?>

                <button class="car_details_prev_btn" onclick="carDetailsCarousel.moveSlide(-1)">❮</button>
                <button class="car_details_next_btn" onclick="carDetailsCarousel.moveSlide(1)">❯</button>
            </div>

            <div class="car_details_dots">
                <?php foreach ($images as $index => $image): ?>
                <span class="car_details_dot <?php echo $index === 0 ? 'active' : ''; ?>"
                    onclick="carDetailsCarousel.currentSlide(<?php echo $index; ?>)"></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content">
            <?php
            $result = mysqli_query($conn, "SELECT name, year FROM cars WHERE car_id = $car_id");
            $cars = mysqli_fetch_assoc($result);      
            ?>
            <div>
                <div class="car-title">
                    <h1><span class="car-title-name"><?php echo $cars['name']; ?></span><span class="car-title-year">
                            <?php echo $cars['year']; ?></span></h1>
                </div>
                <?php
                $sql = "
                SELECT carbrand.brand_name, carbrand.logo_url
                FROM cars
                INNER JOIN carbrand ON cars.brand_id = carbrand.brand_id
                WHERE cars.car_id = ?
                ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $car_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                ?>
                <div class="brand">
                    <img src="<?php echo $row['logo_url']; ?>" alt="" width="200" height="155" class="brand-logo" />
                    <h3 class="brand-title"><?php echo $row['brand_name']; ?></h3>
                </div>
            </div>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM cars WHERE car_id = $car_id");
            $cars = mysqli_fetch_assoc($result);      
            ?>
            <div class="key-stats">
                <div class="stat-card">
                    <div class="stat-icon engine">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 11h4a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1Z" />
                            <path d="M8 10V8h3" />
                            <path d="M9 8h6a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3" />
                            <path d="M18 12V8h2a2 2 0 0 1 2 2v2" />
                            <path d="M14 16h2a2 2 0 0 0 2-2v-2" />
                            <path d="M3 6V5a1 1 0 0 1 1-1h3" />
                            <path d="M3 10v6a1 1 0 0 0 1 1h3" />
                            <path d="M3 13h5" />
                            <path d="M9 19h5" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <p class="stat-label">Engine</p>
                        <p class="stat-value"><?php echo $cars['engine']; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon horsepower">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="8" />
                            <path d="M12 2v2" />
                            <path d="M12 20v2" />
                            <path d="m4.93 4.93 1.41 1.41" />
                            <path d="m17.66 17.66 1.41 1.41" />
                            <path d="M2 12h2" />
                            <path d="M20 12h2" />
                            <path d="m6.34 17.66-1.41 1.41" />
                            <path d="m19.07 4.93-1.41 1.41" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <p class="stat-label">Horsepower</p>
                        <p class="stat-value"><?php echo $cars['horsepower']; ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon quarter-mile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <div class="stat-info">
                        <p class="stat-label">Quarter Mile</p>
                        <p class="stat-value"><?php echo $cars['quarter_mile']; ?></p>
                    </div>
                </div>
            </div>

            <div class="specifications">
                <?php
                $sql = "SELECT category, spec_key, spec_value 
                        FROM specifications 
                        WHERE car_id = $car_id 
                        ORDER BY category, id";
                $result = $conn->query($sql);
                $specifications = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $specifications[$row['category']][] = [
                            'spec_key' => $row['spec_key'],
                            'spec_value' => $row['spec_value']
                        ];
                    }
                } else {
                    echo "No specifications found for this car.";
                }
                foreach ($specifications as $category => $items): 
                ?>
                <div class="spec-section">
                    <h2 class="spec-title"><?= htmlspecialchars($category) ?></h2>
                    <div class="spec-details">
                        <?php foreach ($items as $item): ?>
                        <div class="spec-item">
                            <span class="spec-key"><?= htmlspecialchars($item['spec_key']) ?></span>
                            <span class="spec-value"><?= htmlspecialchars($item['spec_value']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="spec-section">
                    <?php
                    $sql = "SELECT description FROM cars WHERE car_id = $car_id";
                    $result = $conn->query($sql);
                    ?>
                    <h2 class="spec-title">Abot the beast</h2>
                    <div>
                        <div class="spec-key">
                            <p1>
                                <?php
                                if ($result->num_rows > 0) {
                                  $row = $result->fetch_assoc();
                                  echo "<div class='description'>" . nl2br($row["description"]) . "</div>";
                                } else {
                                    echo "Car description not found.";
                                }
                                ?>
                            </p1>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <section class="new-arrivals">
            <div class="container2">
                <h2>New Arrivals</h2>
                <div class="card-grid">

                    <?php
                    $sql = "SELECT car_id FROM cars ORDER BY car_id DESC LIMIT 3";
                    $result = $conn->query($sql);
                    $car_id1 = $car_id2 = $car_id3 = null;
                    $rowCount = 0;
                    while ($row = $result->fetch_assoc()) {
                        $rowCount++;
                        if ($rowCount == 1) {
                            $car_id1 = $row['car_id'];
                        } elseif ($rowCount == 2) {
                            $car_id2 = $row['car_id'];
                        } elseif ($rowCount == 3) {
                            $car_id3 = $row['car_id'];
                        }
                    }
                    ?>
                    <?php
                    $car_id = $car_id1;
                    $result = mysqli_query($conn, "SELECT * FROM cars WHERE car_id = $car_id");
                    $cars = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card" data-scroll>
                        <a href="car-details.php?car_id=<?php echo $cars['car_id']; ?>">
                            <?php
                            $sql = "SELECT id FROM images WHERE car_id = ? ORDER BY id ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $car_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $first_id = $row['id'];
                            $result = mysqli_query($conn, "SELECT * FROM images WHERE id = $first_id");
                            $images = mysqli_fetch_assoc($result);
                            ?>
                            <div class="card-image"
                                style="background-image: url('<?php echo $images['image_url']; ?>')"></div>
                            <div class="card-content">
                                <?php
                                $sql = "
                                SELECT carbrand.brand_name, carbrand.logo_url
                                FROM cars
                                INNER JOIN carbrand ON cars.brand_id = carbrand.brand_id
                                WHERE cars.car_id = ?
                                ";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $car_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                ?>
                                <h3><span><img src="<?php echo $row['logo_url']; ?>" alt="" width="18" /></span>
                                    <span><?php echo $cars['name']; ?></span>
                                </h3>
                                <p><?php echo substr($cars['description'], 0, 100); ?>...</p>
                            </div>
                        </a>
                    </div>

                    <?php
                    $car_id = $car_id2;
                    $result = mysqli_query($conn, "SELECT * FROM cars WHERE car_id = $car_id");
                    $cars = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card" data-scroll>
                        <a href="car-details.php?car_id=<?php echo $cars['car_id']; ?>">
                            <?php
                            $sql = "SELECT id FROM images WHERE car_id = ? ORDER BY id ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $car_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $first_id = $row['id'];
                            $result = mysqli_query($conn, "SELECT * FROM images WHERE id = $first_id");
                            $images = mysqli_fetch_assoc($result);
                            ?>
                            <div class="card-image"
                                style="background-image: url('<?php echo $images['image_url']; ?>')"></div>
                            <div class="card-content">
                                <?php
                                $sql = "
                                SELECT carbrand.brand_name, carbrand.logo_url
                                FROM cars
                                INNER JOIN carbrand ON cars.brand_id = carbrand.brand_id
                                WHERE cars.car_id = ?
                                ";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $car_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                ?>
                                <h3><span><img src="<?php echo $row['logo_url']; ?>" alt="" width="18" /></span>
                                    <span><?php echo $cars['name']; ?></span>
                                </h3>
                                <p><?php echo substr($cars['description'], 0, 100); ?>...</p>
                            </div>
                        </a>
                    </div>

                    <?php
                    $car_id = $car_id3;
                    $result = mysqli_query($conn, "SELECT * FROM cars WHERE car_id = $car_id");
                    $cars = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card" data-scroll>
                        <a href="car-details.php?car_id=<?php echo $cars['car_id']; ?>">
                            <?php
                            $sql = "SELECT id FROM images WHERE car_id = ? ORDER BY id ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $car_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $first_id = $row['id'];
                            $result = mysqli_query($conn, "SELECT * FROM images WHERE id = $first_id");
                            $images = mysqli_fetch_assoc($result);
                            ?>
                            <div class="card-image"
                                style="background-image: url('<?php echo $images['image_url']; ?>')"></div>
                            <div class="card-content">
                                <?php
                                $sql = "
                                SELECT carbrand.brand_name, carbrand.logo_url
                                FROM cars
                                INNER JOIN carbrand ON cars.brand_id = carbrand.brand_id
                                WHERE cars.car_id = ?
                                ";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $car_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                ?>
                                <h3><span><img src="<?php echo $row['logo_url']; ?>" alt="" width="18" /></span>
                                    <span><?php echo $cars['name']; ?></span>
                                </h3>
                                <p><?php echo substr($cars['description'], 0, 100); ?>...</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </div>
    <?php require_once __DIR__ . '/includes/footer.php'; ?>

    <script src="assets/js/script_2.js"></script>
</body>

</html>