<?php
require_once __DIR__ . '/db/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/includes/header.php';?>
    <title>Car Spotter Hub</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
</head>

<body>

    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <section class="hero">
        <video class="hero-video" autoplay loop muted playsinline>
            <source src="assets/img/hero_video.mp4" type="video/mp4">
        </video>
        <div class="hero-content">
            <h1>Experience Automotive Excellence</h1>
            <p>Discover the world's most exceptional cars through the lens of passionate enthusiasts</p>
            <button id="startExploringBtn" class="cta-button">Start Exploring</button>
        </div>
    </section>

    <div id="searchOverlay" class="search-overlay">
        <div class="search-container">
            <input type="text" id="carSearch" placeholder="Search cars..." autocomplete="off">
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>

    <section class="featured">
        <div class="container">
            <h2>Featured Highlights</h2>
            <div class="card-grid">

                <?php
                $car_id = 1;
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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
                $car_id = 2;
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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
                $car_id = 3;
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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

    <section class="new-arrivals">
        <div class="container">
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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
                        <div class="card-image" style="background-image: url('<?php echo $images['image_url']; ?>')">
                        </div>
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

    <?php require_once __DIR__ . '/includes/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>

</html>