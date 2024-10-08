<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-3xl font-semibold mb-6 text-center">Warehouse List</h2>

        <div class="mb-4 text-center">
            <a href="form.php" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Add New Warehouse
            </a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Name</th>
                    <th class="border border-gray-300 p-2">Location</th>
                    <th class="border border-gray-300 p-2">Capacity</th>
                    <th class="border border-gray-300 p-2">Status</th>
                    <th class="border border-gray-300 p-2">Opening Hour</th>
                    <th class="border border-gray-300 p-2">Closing Hour</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'database.php';
                include_once 'warehouse.php';

                $database = new Database();
                $db = $database->getConnection();
                $gudang = new Gudang($db);

                if($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($_POST['action'] == 'create') {
                        $gudang->name = $_POST['name'];
                        $gudang->location = $_POST['location'];
                        $gudang->capacity = $_POST['capacity'];
                        $gudang->status = $_POST['status'];
                        $gudang->opening_hour = $_POST['opening_hour'];
                        $gudang->closing_hour = $_POST['closing_hour'];
                        $gudang->create();
                    } elseif ($_POST['action'] == 'delete') {
                      $gudang->id = $_POST['id'];
                      $gudang->delete();
                      header("Location: table.php"); // Redirect to the same page to refresh
                      exit(); // Make sure the script stops here
                    } elseif ($_POST['action'] == 'update') {
                        $gudang->id = $_POST['id'];
                        $gudang->name = $_POST['name'];
                        $gudang->location = $_POST['location'];
                        $gudang->capacity = $_POST['capacity'];
                        $gudang->status = $_POST['status'];
                        $gudang->opening_hour = $_POST['opening_hour'];
                        $gudang->closing_hour = $_POST['closing_hour'];
                        $gudang->update();
                    }
                }

                $stmt = $gudang->read();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td class='border border-gray-300 p-2'>{$row['id']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['name']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['location']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['capacity']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['status']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['opening_hour']}</td>";
                    echo "<td class='border border-gray-300 p-2'>{$row['closing_hour']}</td>";
                    echo "<td class='border border-gray-300 p-2'>
                            <form method='POST' class='inline'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' name='action' value='delete' class='bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
