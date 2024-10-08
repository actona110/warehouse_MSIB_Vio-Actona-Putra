<?php
include_once 'database.php';
include_once 'warehouse.php';

$database = new Database();
$db = $database->getConnection();
$gudang = new Gudang($db);

// Check if id is set
if (isset($_GET['id'])) {
    $gudang->id = $_GET['id'];
    $stmt = $gudang->readOne();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Warehouse not found.");
    }

    // Assign values to variables for the form
    $name = $row['name'];
    $location = $row['location'];
    $capacity = $row['capacity'];
    $status = $row['status'];
    $opening_hour = $row['opening_hour'];
    $closing_hour = $row['closing_hour'];
} else {
    die("Invalid ID.");
}

// Handle the form submission for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];
    
    if ($gudang->update()) {
        header("Location: table.php"); // Redirect to the warehouse list after update
        exit();
    } else {
        echo "Error updating warehouse.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-3xl font-semibold mb-6 text-center">Edit Warehouse</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $gudang->id; ?>">
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" class="mt-1 block w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Location</label>
                <input type="text" name="location" value="<?php echo $location; ?>" class="mt-1 block w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Capacity</label>
                <input type="number" name="capacity" value="<?php echo $capacity; ?>" class="mt-1 block w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border border-gray-300 p-2 rounded">
                    <option value="aktif" <?php echo ($status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                    <option value="tidak_aktif" <?php echo ($status == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Opening Hour</label>
                <input type="time" name="opening_hour" value="<?php echo $opening_hour; ?>" class="mt-1 block w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Closing Hour</label>
                <input type="time" name="closing_hour" value="<?php echo $closing_hour; ?>" class="mt-1 block w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update Warehouse</button>
            </div>
        </form>
    </div>
</body>
</html>
