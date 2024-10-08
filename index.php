<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .form-container, .table-container {
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn.delete {
            background-color: #f44336;
        }
        .btn.update {
            background-color: #ffa500;
        }
    </style>
</head>
<body>
    <h1>Warehouse Management</h1>

    <div class="form-container">
        <form action="" method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Location:</label>
            <input type="text" name="location" required>
            <label>Capacity:</label>
            <input type="number" name="capacity" required>
            <label>Status:</label>
            <select name="status">
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Tidak Aktif</option>
            </select>
            <label>Opening Hour:</label>
            <input type="time" name="opening_hour" required>
            <label>Closing Hour:</label>
            <input type="time" name="closing_hour" required>
            <button type="submit" name="action" value="create" class="btn">Add Warehouse</button>
        </form>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Opening Hour</th>
                <th>Closing Hour</th>
                <th>Actions</th>
            </tr>

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
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['location']}</td>";
                echo "<td>{$row['capacity']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['opening_hour']}</td>";
                echo "<td>{$row['closing_hour']}</td>";
                echo "<td>
                        <form style='display:inline;' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' name='action' value='delete' class='btn delete'>Delete</button>
                        </form>
                        <form style='display:inline;' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <input type='text' name='name' value='{$row['name']}' required>
                            <input type='text' name='location' value='{$row['location']}' required>
                            <input type='number' name='capacity' value='{$row['capacity']}' required>
                            <select name='status'>
                                <option value='aktif' ".($row['status'] == 'aktif' ? 'selected' : '').">Aktif</option>
                                <option value='tidak_aktif' ".($row['status'] == 'tidak_aktif' ? 'selected' : '').">Tidak Aktif</option>
                            </select>
                            <input type='time' name='opening_hour' value='{$row['opening_hour']}' required>
                            <input type='time' name='closing_hour' value='{$row['closing_hour']}' required>
                            <button type='submit' name='action' value='update' class='btn update'>Update</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>

        </table>
    </div>
</body>
</html>
