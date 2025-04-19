<?php
require_once __DIR__ . '/../db/config.php';
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function isMainAdmin() {
    return isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'main_admin';
}

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'add_brand':
            $stmt = $conn->prepare('INSERT INTO carbrand (brand_name, logo_url) VALUES (?, ?)');
            $stmt->bind_param('ss', $_POST['brand_name'], $_POST['logo_url']);
            $stmt->execute();
            break;

        case 'add_car':
            $stmt = $conn->prepare('INSERT INTO cars (name, year, engine, horsepower, quarter_mile, description, brand_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sisissi', $_POST['car_name'], $_POST['year'], $_POST['engine'], $_POST['horsepower'], $_POST['quarter_mile'], $_POST['description'], $_POST['brand_id']);
            $stmt->execute();
            break;

        case 'add_image':
            $stmt = $conn->prepare('INSERT INTO images (car_id, image_url) VALUES (?, ?)');
            $stmt->bind_param('is', $_POST['car_id'], $_POST['image_url']);
            $stmt->execute();
            break;

        case 'add_spec':
            $stmt = $conn->prepare('INSERT INTO specifications (car_id, category, spec_key, spec_value) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('isss', $_POST['car_id'], $_POST['category'], $_POST['spec_key'], $_POST['spec_value']);
            $stmt->execute();
            break;
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$brandsList = $conn->query('SELECT * FROM carbrand ORDER BY brand_name')->fetch_all(MYSQLI_ASSOC);
$carsList = $conn->query('SELECT * FROM cars ORDER BY name')->fetch_all(MYSQLI_ASSOC);

$brandsData = $conn->query('SELECT * FROM carbrand ORDER BY brand_id DESC')->fetch_all(MYSQLI_ASSOC);
$carsData = $conn->query('SELECT c.*, b.brand_name FROM cars c JOIN carbrand b ON c.brand_id = b.brand_id ORDER BY c.car_id DESC')->fetch_all(MYSQLI_ASSOC);
$imagesData = $conn->query('SELECT i.*, c.name as car_name FROM images i JOIN cars c ON i.car_id = c.car_id ORDER BY i.id DESC')->fetch_all(MYSQLI_ASSOC);
$specsData = $conn->query('SELECT s.*, c.name as car_name FROM specifications s JOIN cars c ON s.car_id = c.car_id ORDER BY s.id DESC')->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/../includes/header.php';?>
    <title>Car Database Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles_5.css">
    <link rel="icon" href="images/logo-white.png" type="image/png">
</head>

<body>

    <div class="nav-container">
        <div class="nav-left">
            <h1>CarSpotterHub Admin Panel</h1>
        </div>
        <div class="nav-right">
            <div class="user-info">
                <i class="fas fa-user"></i>
                <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                (<?php echo htmlspecialchars($_SESSION['admin_role']); ?>)
            </div>
            <?php if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'main_admin'): ?>
            <button onclick="showAddCoAdminModal()" class="nav-btn btn-secondary">
                <i class="fas fa-plus"></i> Add Co-Admin
            </button>
            <?php endif; ?>
            <a href="index.php" class="nav-btn btn-secondary">
                <i class="fas fa-home"></i> Main Page
            </a>
            <a href="admin/admin_panel.php?logout" class="nav-btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    <nav>
        <div class="nav-bar-container">
            <div class="tabs">
                <button class="tab active" onclick="showTab('brands')">Brands</button>
                <button class="tab" onclick="showTab('cars')">Cars</button>
                <button class="tab" onclick="showTab('images')">Images</button>
                <button class="tab" onclick="showTab('specs')">Specifications</button>
            </div>
        </div>
    </nav>



    <div id="addCoAdminModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Co-Admin</h2>
            <form id="addCoAdminForm">
                <div class="form-group">
                    <label for="newUsername">Username</label>
                    <input type="text" id="newUsername" name="username" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">Password</label>
                    <input type="password" id="newPassword" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <label for="adminPassword">Your Password</label>
                    <input type="password" id="adminPassword" name="admin_password" required>
                </div>
                <button type="submit" class="nav-btn btn-primary">Add Co-Admin</button>
            </form>
        </div>
    </div>

    <main>
        <section id="brands" class="tab-content active">
            <div class="form-container">
                <h2>Add New Brand</h2>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="add_brand">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" id="brand_name" name="brand_name" required>
                    </div>
                    <div class="form-group">
                        <label for="logo_url">Logo URL</label>
                        <input type="url" id="logo_url" name="logo_url" required>
                    </div>
                    <button type="submit" class="nav-btn btn-primary">Add Brand</button>
                </form>
            </div>

            <div class="list-container">
                <h2>Brands List</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand Name</th>
                                <th>Logo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brandsData as $brand): ?>
                            <tr>
                                <td><?= htmlspecialchars($brand['brand_id']) ?></td>
                                <td><?= htmlspecialchars($brand['brand_name']) ?></td>
                                <td><img src="<?= htmlspecialchars($brand['logo_url']) ?>"
                                        alt="<?= htmlspecialchars($brand['brand_name']) ?>" style="height: 40px;"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="cars" class="tab-content">
            <div class="form-container">
                <h2>Add New Car</h2>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="add_car">
                    <div class="form-group">
                        <label for="car_name">Car Name</label>
                        <input type="text" id="car_name" name="car_name" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="engine">Engine</label>
                        <input type="text" id="engine" name="engine" required>
                    </div>
                    <div class="form-group">
                        <label for="horsepower">Horsepower</label>
                        <input type="number" id="horsepower" name="horsepower" required>
                    </div>
                    <div class="form-group">
                        <label for="quarter_mile">Quarter Mile</label>
                        <input type="text" id="quarter_mile" name="quarter_mile" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        <select id="brand_id" name="brand_id" required>
                            <?php foreach ($brandsList as $brand): ?>
                            <option value="<?= htmlspecialchars($brand['brand_id']) ?>">
                                <?= htmlspecialchars($brand['brand_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="nav-btn btn-primary">Add Car</button>
                </form>
            </div>

            <div class="list-container">
                <h2>Cars List</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Brand</th>
                                <th>Engine</th>
                                <th>Horsepower</th>
                                <th>Quarter Mile</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carsData as $car): ?>
                            <tr>
                                <td><?= htmlspecialchars($car['car_id']) ?></td>
                                <td><?= htmlspecialchars($car['name']) ?></td>
                                <td><?= htmlspecialchars($car['year']) ?></td>
                                <td><?= htmlspecialchars($car['brand_name']) ?></td>
                                <td><?= htmlspecialchars($car['engine']) ?></td>
                                <td><?= htmlspecialchars($car['horsepower']) ?></td>
                                <td><?= htmlspecialchars($car['quarter_mile']) ?></td>
                                <td><?= htmlspecialchars($car['description']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="images" class="tab-content">
            <div class="form-container">
                <h2>Add New Image</h2>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="add_image">
                    <div class="form-group">
                        <label for="car_id">Car</label>
                        <select id="car_id" name="car_id" required>
                            <?php foreach ($carsList as $car): ?>
                            <option value="<?= htmlspecialchars($car['car_id']) ?>">
                                <?= htmlspecialchars($car['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="url" id="image_url" name="image_url" required>
                    </div>
                    <button type="submit" class="nav-btn btn-primary">Add Image</button>
                </form>
            </div>

            <div class="list-container">
                <h2>Images List</h2>
                <div class="image-grid">
                    <?php foreach ($imagesData as $image): ?>
                    <div class="image-card">
                        <img src="<?= htmlspecialchars($image['image_url']) ?>"
                            alt="<?= htmlspecialchars($image['car_name']) ?>">
                        <div class="image-info">
                            <p><?= htmlspecialchars($image['car_name']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="specs" class="tab-content">
            <div class="form-container">
                <h2>Add New Specification</h2>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="add_spec">
                    <div class="form-group">
                        <label for="spec_car_id">Car</label>
                        <select id="spec_car_id" name="car_id" required>
                            <?php foreach ($carsList as $car): ?>
                            <option value="<?= htmlspecialchars($car['car_id']) ?>">
                                <?= htmlspecialchars($car['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="spec_key">Specification Key</label>
                        <input type="text" id="spec_key" name="spec_key" required>
                    </div>
                    <div class="form-group">
                        <label for="spec_value">Specification Value</label>
                        <input type="text" id="spec_value" name="spec_value" required>
                    </div>
                    <button type="submit" class="nav-btn btn-primary">Add Specification</button>
                </form>
            </div>

            <div class="list-container">
                <h2>Specifications List</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Car</th>
                                <th>Category</th>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($specsData as $spec): ?>
                            <tr>
                                <td><?= htmlspecialchars($spec['id']) ?></td>
                                <td><?= htmlspecialchars($spec['car_name']) ?></td>
                                <td><?= htmlspecialchars($spec['category']) ?></td>
                                <td><?= htmlspecialchars($spec['spec_key']) ?></td>
                                <td><?= htmlspecialchars($spec['spec_value']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
    function showTab(tabId) {
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.remove('active'));

        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => tab.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
    }

    const modal = document.getElementById('addCoAdminModal');
    const closeBtn = document.getElementsByClassName('close')[0];

    window.showAddCoAdminModal = function() {
        modal.style.display = 'block';
    }

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    const addCoAdminForm = document.getElementById('addCoAdminForm');
    addCoAdminForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = {
            username: document.getElementById('newUsername').value,
            password: document.getElementById('newPassword').value,
            confirm_password: document.getElementById('confirmPassword').value,
            admin_password: document.getElementById('adminPassword').value
        };

        if (formData.password !== formData.confirm_password) {
            alert('Passwords do not match');
            return;
        }

        try {
            const response = await fetch('admin/add_co_admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (data.success) {
                alert('Co-Admin added successfully');
                modal.style.display = 'none';
                addCoAdminForm.reset();
            } else {
                alert(data.error || 'Failed to add co-admin');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
    </script>
</body>

</html>